<?php
/**
 * Created by PhpStorm.
 * User: simonharvan
 * Date: 5.6.17
 * Time: 12:49
 */

namespace App\Http\Controllers\Admin\Badges;


use App\Http\Controllers\Admin\AdminBadges\AdminBadgesController;
use App\Http\Controllers\Admin\AdminLogsHelper;
use App\Http\Controllers\Admin\Controller;
use App\Models\Badge\BadgeType;
use App\Models\Badge\Condition;
use App\Models\Core\AdminLogType;
use App\Models\EventType\EventType;
use DB;
use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function index() {
        $badges = BadgeType::query()->paginate(10);

        return view('pages.badges.index',[
           'badges' => $badges,
        ]);
    }

    public function create() {
        $eventTypes = EventType::all();

        return view('pages.badges.create', [
            'eventTypes' => $eventTypes,
        ]);
    }

    public function store(Request $request) {
        $badge = new BadgeType();

        $data = json_decode($request->json,true);;

        DB::beginTransaction();

        $lastCondition = null;
        foreach ($data['conditions'] as $conditionJson) {
            $condition = new Condition();
            $select = strtoupper(substr($conditionJson['script'],0,6));
            if ($select != 'SELECT' && $select != ""){
                return response('Script has to be SELECT', 400);
            }
            $condition->script = $conditionJson['script'];
            $condition->event_type_id = $conditionJson['event_type'];
            $condition->operator = $conditionJson['operator'];
            $condition->number = $conditionJson['number'];
            if ($lastCondition != null){
                $condition->condition()->associate($lastCondition);
            }
            $condition->save();
            $lastCondition = $condition;
        }
        $badge->name = $data['name'];
        $badge->description = $data['description'];
        $badge->condition()->associate($lastCondition);
        $badge->save();
        if ($request->hasFile('badge-picture')){
            $badge->saveMedia($request->file('badge-picture'));
        }
        DB::commit();

        AdminLogsHelper::log(AdminLogType::BADGE_CREATED, auth()->user(), AdminLogType::BADGE_CREATED . ' ' . $badge->name);

        return AdminBadgesController::checkForNewBadges('admin.badges.index');
    }


    public function edit($id){
        $badge = BadgeType::with(['condition'])->findOrFail($id);
        $eventTypes = EventType::all();

        return view('pages.badges.edit',[
            'badge' => $badge,
            'eventTypes' => $eventTypes,
        ]);
    }

    public function update(Request $request, $id){
        $badge = BadgeType::findOrFail($id);

        $this->deleteCondition($badge->condition_id);

        $data = json_decode($request->json,true);;

        DB::beginTransaction();

        $lastCondition = null;
        foreach ($data['conditions'] as $conditionJson) {
            $condition = new Condition();
            $select = strtoupper(substr($conditionJson['script'],0,6));
            if ($select != 'SELECT' && $select != ""){
                return response('Script has to be SELECT', 400);
            }
            $condition->script = $conditionJson['script'];
            $condition->event_type_id = $conditionJson['event_type'];
            $condition->operator = $conditionJson['operator'];
            $condition->number = $conditionJson['number'];
            if ($lastCondition != null){
                $condition->condition()->associate($lastCondition);
            }
            $condition->save();
            $lastCondition = $condition;
        }
        $badge->name = $data['name'];
        $badge->description = $data['description'];
        $badge->condition()->associate($lastCondition);
        $badge->save();
        if ($request->hasFile('badge-picture')){
            $badge->saveMedia($request->file('badge-picture'));
        }
        DB::commit();


        AdminLogsHelper::log(AdminLogType::BADGE_UPDATED, auth()->user(), AdminLogType::BADGE_UPDATED . ' ' . $badge->name);

        return redirect()->route('admin.badges.index');
    }

    public function destroy($id){
        $badge = BadgeType::with(['condition'])->findOrFail($id);

        $conditionId = $badge->condition_id;
        $name = $badge->name;

        $badge->deleteMedia();
        $badge->delete();

        $this->deleteCondition($conditionId);

        AdminLogsHelper::log(AdminLogType::BADGE_DELETED, auth()->user(), AdminLogType::BADGE_DELETED . ' ' . $name);


        return redirect()->route('admin.badges.index');
    }

    function deleteCondition($conditionId){
        $condition = Condition::with(['condition'])->findOrFail($conditionId);
        $id = $condition->condition_id;
        $condition->delete();

        if (isset($id)){
            $this->deleteCondition($id);
        }
    }

}