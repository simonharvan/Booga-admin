<?php namespace Kitndo\Http\Requests;

use \Illuminate\Foundation\Http\FormRequest as HttpFormRequest;
use Illuminate\Http\JsonResponse;

class FormRequest extends HttpFormRequest
{
    public function before(array $data)
    {
        return [];
    }
    
    public function after(array $data)
    {
        return [];
    }
    
    public function errorAttributes()
    {
        return [];
    }
    
    public function transformErrors(array $errors)
    {
        $transformed = [];
        
        $attributes = $this->errorAttributes();
        
        if (count($attributes)) {
            foreach ($errors as $name => $error) {
                $keys = array_where($attributes, function ($value, $key) use ($name) {
                    return str_is($key, $name);
                });
                
                if ($keys) {
                    $transformed[array_shift($keys)][] = array_shift($error);
                } else {
                    $transformed[$name] = $error;
                }
                
            }
            
            return $transformed;
        }
        
        return $errors;
    }
    
    public function response(array $errors)
    {
        $old = $this->except(array_merge($this->dontFlash, ['_modal']));
        $old = array_merge($old, $this->after($old));
        
        if ($this->expectsJson()) {
            return new JsonResponse($errors, 422);
        }
        
        return $this->redirector->to($this->getRedirectUrl())
            ->with('modal', $this->_modal)
            ->with('modal_url', $this->url())
            ->withInput($old)
            ->withErrors($this->transformErrors($errors), $this->errorBag);
    }
    
    public function all()
    {
        $data = parent::all();
        
        return array_merge($data, $this->before($data));
    }
    
    public function validate()
    {
        parent::validate();
    
        $this->afterSuccess();
    }
    
    public function afterSuccess()
    {
        
    }
}