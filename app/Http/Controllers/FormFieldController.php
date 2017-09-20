<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FormField;
use Illuminate\Http\Request;
use App\Form;
use App\Classes\InputType;

class FormFieldController extends Controller {

        /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}
    
        /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$form_fields = FormField::orderBy('id', 'desc')->paginate(10);

		return view('form_fields.index', compact('form_fields'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $forms = Form::all();
        $inputs = InputType::getInputTypeList();
		return view('form_fields.create', compact('forms','inputs'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		$form_field = new FormField();

		$form_field->title = $request->input("title");
        $form_field->type = $request->input("type");
        $form_field->form_id = $request->input("form_id");

		$form_field->save();

		return redirect()->route('form_fields.index')->with('message', 'Item created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$form_field = FormField::findOrFail($id);

		return view('form_fields.show', compact('form_field'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form_field = FormField::findOrFail($id);
        $forms = Form::all();
        $inputs = InputType::getInputTypeList();
		return view('form_fields.edit', compact('form_field','forms','inputs'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @param Request $request
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$form_field = FormField::findOrFail($id);

		$form_field->title = $request->input("title");
        $form_field->type = $request->input("type");
        $form_field->form_id = $request->input("form_id");

		$form_field->save();

		return redirect()->route('form_fields.index')->with('message', 'Item updated successfully.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$form_field = FormField::findOrFail($id);
		$form_field->delete();

		return redirect()->route('form_fields.index')->with('message', 'Item deleted successfully.');
	}

    public function saveOrder(Request $request, $id) {
       // dd($request->fields);
        foreach($request->fields as $key => $field) {
            $form_field = FormField::findOrFail($field);
            $form_field->order = $request->orders[$key];
            $form_field->save();
        }
        return back()->with('message', 'Order saved');
    }



}
