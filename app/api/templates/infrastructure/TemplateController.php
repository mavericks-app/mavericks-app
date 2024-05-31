<?php
namespace App\api\templates\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\templates\application\Templates;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class TemplateController extends BaseController implements CrudController
{

    protected $models;

    public function __construct(Templates $models)
    {
       $this->models=$models;
    }



    public function get(Request $request)
    {

        $model = $this->models->getId($request->id);

        if ($model) {
            return $this->sendResponse($model, 'Templates get');
        }

    }

    /**
     * Modelos base
     *
     * Modelos base para crear otros endpoints
     */
    public function index(Request $request)
    {

        $models = $this->models->paginate();

        if ($models) {
            return $this->sendResponse($models, 'Templates list');
        }

    }


    public function store(Request $request)
    {

        $data = $request->validate([
            'name'=>['required'],
            'email' => ['required', 'email'],
            ]);


        $model = $this->models->store($data);

        if ($model) {
            return $this->sendResponse($model, 'Templates create');
        }

    }

    public function update(Request $request)
    {

        $data = $request->validate([
            'id'=>['required'],
            'name'=>['nullable','string'],
        ]);

        $model = $this->models->update($data);

        if ($model) {
            return $this->sendResponse($model, 'Templates update');
        }

    }

    public function remove(Request $request)
    {
        try {

            $data = $request->validate([
                'id' => ['required']
            ]);

            $model = $this->models->remove($request->id);

            if ($model) {
                return $this->sendResponse($model, 'Templates deleted');
            }

        }catch (\Exception $e){
            throw  new \Exception("Not found model template");
        }

    }


}
