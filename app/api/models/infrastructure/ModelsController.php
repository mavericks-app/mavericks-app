<?php
namespace App\api\models\infrastructure;

use App\api\core\shared\contracts\infrastructure\CrudController;
use App\api\core\shared\contracts\infrastructure\BaseController;
use App\api\models\application\Models;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


class ModelsController extends BaseController implements CrudController
{

    protected $models;

    public function __construct(Models $models)
    {
       $this->models=$models;
    }



    public function get(Request $request)
    {

        $model = $this->models->getId($request->id);

        if ($model) {
            return $this->sendResponse($model, 'Model get');
        }

    }

    public function index(Request $request)
    {

        $models = $this->models->paginate();

        if ($models) {
            return $this->sendResponse($models, 'Models list');
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
            return $this->sendResponse($model, 'Model create');
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
            return $this->sendResponse($model, 'User update');
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
                return $this->sendResponse($model, 'Model deleted');
            }

        }catch (\Exception $e){
            throw  new \Exception("Not found model");
        }

    }


}
