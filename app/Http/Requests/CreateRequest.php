<?php

namespace App\Http\Requests;

use App\DTO\Record\CreateRecord;
use DemeterChain\C;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cost' => 'required|integer|min:3',
            'name' => 'required|min:4'
        ];
    }

    public function convertToDto(): CreateRecord
    {
        return new CreateRecord($this->_token, $this->cost, $this->select, $this->name);
    }
}
