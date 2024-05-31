<?php
namespace App\api\templates\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\templates\application\Templates;
use Illuminate\Http\Request;



class TemplatesController extends BaseController implements CrudController
{

    protected $templates;

    public function __construct(Templates $templates)
    {
       $this->templates=$templates;
    }



    public function get(Request $request)
    {

        $template = $this->templates->getId($request->id);

        if ($template) {
            return $this->sendResponse($template, 'Templates get');
        }

    }

    /**
     * Templates
     *
     *
     */
    public function index(Request $request)
    {

        $templates = $this->templates->paginate();

        if ($templates) {
            return $this->sendResponse($templates, 'Templates list');
        }

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            ]);


        $template = $this->templates->store($data);

        if ($template) {
            return $this->sendResponse($template, 'Templates create');
        }

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id'=>['required'],
            'name'=>['nullable','string'],
        ]);

        $template = $this->templates->update($data);

        if ($template) {
            return $this->sendResponse($template, 'Templates update');
        }

    }

    public function remove(Request $request)
    {
        try {

            $data = $request->validate([
                'id' => ['required']
            ]);

            $template = $this->templates->remove($request->id);

            if ($template) {
                return $this->sendResponse($template, 'Templates deleted');
            }

        }catch (\Exception $e){
            throw  new \Exception("Not found model template");
        }

    }


}
