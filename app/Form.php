<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Form extends Model
{
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public static function getLitigationOfForm($id,$lid){
      //  dd($lid);
        $litigation = DB::table('litigation_form')
            ->where('form_id', $id)
            ->where('litigation_id', $lid)
            ->select('litigation_form.*')
            ->get();

        return (!empty($litigation)) ? $litigation[0] : array();
    }



    public static function insertFormForLitigation($litigation_id,$form_id,$date_of_action,
                                                   $date_of_acknowledgement,$status=1,$form_attachment){

        DB::table('litigation_form')->insert([
            [
                'litigation_id' => $litigation_id,
                'date_of_action' => $date_of_action,
                'date_of_acknowledgement' => $date_of_acknowledgement,
                'attachment' => $form_attachment,
                'form_id' => $form_id,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);
    }

    public static function updateFormForLitigation($litigation_id,$form_id,$date_of_action,
                                                   $date_of_acknowledgement,$status=1,$form_attachment){
       //dd($date_of_action);
        DB::table('litigation_form')
            ->where('litigation_id', $litigation_id)
            ->where('form_id', $form_id)
            ->update(array(
                'date_of_action' => $date_of_action,
                'date_of_acknowledgement' => $date_of_acknowledgement,
                'attachment' => $form_attachment,
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')

            ));

    }

    /*public static function prepareAttachment($form_attachment, $doc_type_id,$litigation_id){
        //dd($form_attachment);
        $attachment = new Attachment();

        $attachmentName = '';

        while (true) {
            $attachmentName = str_replace(".","",uniqid( "", true)) . '.' .$form_attachment->getClientOriginalExtension();
            if (!file_exists(sys_get_temp_dir() . $attachmentName)) break;
        }

        $form_attachment->move(public_path() . '/uploads', $attachmentName);

        $attachment->file_name = $attachmentName;
        $attachment->file_size = $form_attachment->getClientSize();
        $attachment->content_type = $form_attachment->getClientMimeType();
        $attachment->file_path = '/uploads/' . $attachmentName;

        // TODO get doc type from the name of the input field for most commonly used types (Robaiatul Islam)
        $attachment->doc_type_id = $doc_type_id;
        $attachment->uploaded_by = auth()->user()->id;

        $attachment->save();
        $attachment->litigations()->sync([$litigation_id]);

        return $attachment->file_path;
    }*/


    public static function getFormFiles($lid){
        //dd($lid);
        $files = DB::table('litigation_form')
            ->join('forms', 'litigation_form.form_id', '=', 'forms.id')
            ->where('litigation_form.litigation_id', $lid)
            ->select('forms.*','litigation_form.updated_at as file_updated_at','litigation_form.attachment as file_path')
            ->get();

        return $files;
    }

    public static function getGenericFields($lid,$object,$count) {
        $litigation = DB::table('litigation_form')
            ->where('litigation_form.litigation_id', $lid)
            ->where('litigation_form.form_id', $object->id)
            ->get();
        //dd($litigation);
        $forms[$count] = $object;

        if(!empty($litigation)){
            $forms[$count]->litigation_id = $litigation[0]->litigation_id;
            $forms[$count]->date_of_action = strlen($litigation[0]->date_of_action) ? date('d-m-Y', strtotime($litigation[0]->date_of_action)) : null;
            $forms[$count]->date_of_acknowledgement = strlen($litigation[0]->date_of_acknowledgement) ? date('d-m-Y', strtotime($litigation[0]->date_of_acknowledgement)) : null;
            $forms[$count]->status = $litigation[0]->status;
            $forms[$count]->form_id = $litigation[0]->form_id;
            $forms[$count]->attachment = $litigation[0]->attachment;
            $forms[$count]->type = (strpos($litigation[0]->attachment,'.pdf') !== false) ? 'pdf' : 'image';
            //dd($forms[$count]->type);
        }

        else {
            $forms[$count]->litigation_id = null;
            $forms[$count]->date_of_action = null;
            $forms[$count]->date_of_acknowledgement = null;
            $forms[$count]->status = null;
            $forms[$count]->form_id = null;
            $forms[$count]->attachment = null;
        }
    }

    public static function getCustomFields($lid,$object,$count) {
        $forms[$count] = $object;
        //dd($object);
        $fields = DB::table('form_fields')
            ->leftJoin('field_litigation','field_litigation.field_id','=','form_fields.id')
            ->where('form_fields.form_id', $object->id)
            ->where('field_litigation.litigation_id', $lid)
            ->get();
        /*echo '<pre>';
        print_r($fields);
        echo '</pre>';
        dd($fields);*/
        $forms[$count]->fields = $fields;
        if(count($fields)<1){
            $fields = DB::table('form_fields')
                ->where('form_fields.form_id', $object->id)
                ->get();
                $forms[$count]->fields = $fields;
            foreach ($fields as $field) {
                $field->value = '';
            }
            }


       // dd($fields);
    }

    public static function saveCustomFields($fields,$litigation_id){
        foreach($fields as $key => $field) {
            $id = intval(str_replace("field-","",$key));
            //dd($id);
            $litigation = DB::table('field_litigation')
                ->where('field_id', $id)
                ->where('litigation_id', $litigation_id)
                ->select('field_litigation.*')
                ->get();
            if(!empty($litigation)) {
                DB::table('field_litigation')
                    ->where('litigation_id', $litigation_id)
                    ->where('field_id', $id)
                    ->update(array('value' => $field));
            }
            else {
                DB::table('field_litigation')->insert([
                    [
                        'litigation_id' => $litigation_id,
                        'field_id' => $id,
                        'value' => $field,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]
                ]);
            }
        }
    }
}
