<?php namespace App\Models;


use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model {

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'data_creazione';

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'data_modifica';

    /**
     * The name of the "deleted at" column.
     *
     * @var string
     */
    const DELETED_AT = 'data_cancellazione';

    /**
     * The array containing the names of database columns that can't be edited/inserted on storage
     *
     */
    protected $guarded = array('id', 'data_creazione', 'data_modifica');

    protected $messages = array(

    );

    /**
     * The variable for validation rules
     *
     */
    protected $rules = array(

    );


    /**
     * The function for validate
     *
     * @data array
     */
    public function validate($data)
    {
        $validation = Validator::make($data, $this->rules, $this->messages);

        if ($validation->fails()) {
            // set errors and return false
            $this->errors = $validation->messages();
        }

        return $validation;
    }

    /**
     * The function that incapsulate the error variable
     *
     * @errors array
     */
    public function getErrors()
    {
        return $this->errors;
    }




}
