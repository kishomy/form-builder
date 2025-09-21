<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\Field;
use App\Models\Submission;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index(){ $forms = Form::all(); if(request()->wantsJson()) return response()->json($forms); return view('forms.index', compact('forms')); }
    public function create(){ return view('forms.create'); }
    public function store(Request $request){
        $data = $request->validate(['title'=>'required|string|max:255']);
        $form = Form::create($data);
        if($request->has('fields')){
            $fields = is_string($request->input('fields')) ? json_decode($request->input('fields'), true) : $request->input('fields');
            foreach($fields as $f) $form->fields()->create($f);
        }
        return redirect()->route('forms.index');
    }
    public function show(Form $form){ $form->load('fields','submissions'); return view('forms.show', compact('form')); }
    public function edit(Form $form){ $form->load('fields'); return view('forms.edit', compact('form')); }
    public function update(Request $request, Form $form){
        $data = $request->validate(['title'=>'required|string|max:255']);
        $form->update($data);
        if($request->has('fields')){ $form->fields()->delete(); $fields = is_string($request->input('fields')) ? json_decode($request->input('fields'), true) : $request->input('fields'); foreach($fields as $f) $form->fields()->create($f); }
        return redirect()->route('forms.index');
    }
    public function destroy(Form $form){ $form->delete(); return redirect()->route('forms.index'); }
    public function submit(Request $request, Form $form){
        $rules = []; foreach($form->fields as $field) if($field->is_required) $rules['fields.'.$field->id] = 'required';
        $validated = $request->validate($rules);
        $submission = $form->submissions()->create(['uuid'=>Str::uuid(),'data'=>json_encode($request->input('fields', []))]);
        return response()->json(['success'=>true]);
    }
    public function submissionShow(Form $form, Submission $submission){ return view('forms.submission', compact('submission')); }
}
