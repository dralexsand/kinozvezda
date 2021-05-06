<?php


    namespace App\Http\Requests\FilterDataRequests;

    use App\Http\Requests\ApiRequest;

    class GetFilterDataRequest extends \App\Http\Requests\ApiRequest
    {


        public function rules()
        {
            return [
                'id' => 'integer',
                'last_name' => 'string',
                'first_name' => 'string',
                'birthday' => 'string',
                'age' => 'integer',
                'gender' => 'string',
            ];
        }

        public function messages()
        {
            return [
                'id.integer' => 'The field Id must be of type integer',
                'last_name.string' => 'The field last_name must be of type string',
                'first_name.string' => 'The field first_name must be of type string',
                'birthday.string' => 'The field birthday must be of type string',
                'age.integer' => 'The field age must be of type integer',
                'gender.string' => 'The field gender must be of type string',
            ];
        }


    }


