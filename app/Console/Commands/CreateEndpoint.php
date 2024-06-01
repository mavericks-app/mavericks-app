<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateEndpoint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-endpoint {pluralName} {singularName} {--migration=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear base para nuevo endpoint';

    protected $remplaces=[];

    protected $pathApi="";
    protected $pathTemplate="";
    protected $singularTemplateUpper="";
    protected $singularTemplateLower="";
    protected $pluralTemplateUpper="";
    protected $pluralTemplateLower="";

    public function __construct()
    {
        parent::__construct();

        $this->pathApi=app_path()."/api";
        $this->pathTemplate=$this->pathApi."/templates";
        $this->singularTemplateUpper="Template";
        $this->singularTemplateLower="template";
        $this->pluralTemplateUpper="Templates";
        $this->pluralTemplateLower="templates";
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseUrl=$this->pathTemplate;

        $singularName=$this->argument("singularName");
        $pluralName=$this->argument("pluralName");
        $migration=$this->option("migration");

        $this->remplaces=[
            $this->pluralTemplateLower=>strtolower($pluralName),
            $this->pluralTemplateUpper=>ucfirst(strtolower($pluralName)),
            $this->singularTemplateLower=>strtolower($singularName),
            $this->singularTemplateUpper=>ucfirst(strtolower($singularName)),
        ];

        $newUrl = rtrim($this->pathApi."/".$pluralName, '/');

        if (!File::isDirectory($baseUrl)) {
            $this->error("Base directory {$baseUrl} does not exist.");
            return;
        }

        if (!File::isDirectory($newUrl)) {
            File::makeDirectory($newUrl, 0755, true, true);
        }

        $this->duplicateStructure($baseUrl, $newUrl);

        $this->createModel();
        $this->createProvider();

        /*if($migration){
            $this->createMigration();
        }*/


        $this->info("Directory structure duplicated from {$baseUrl} to {$newUrl}.");
    }

    protected function duplicateStructure($baseUrl, $newUrl)
    {
        $files = File::allFiles($baseUrl);

        foreach ($files as $file) {
            $relativePath = Str::after($file->getPathname(), $baseUrl);
            $newFilePath = $newUrl . $relativePath;
            $newFilePath = $this->remplace($newFilePath);

            $directory=$this->remplace($file->getPath());
            if(!File::isDirectory($directory)){
                File::makeDirectory($directory, 0755, true, true);
            }

             if(File::copy($file->getPathname(), $newFilePath)){
                 $this->remplaceFile($newFilePath);
                 $this->info("File duplicated: {$newFilePath}");
             }

        }
    }

    protected function createModel()
    {

        $fileModel=app_path()."/Models/".$this->singularTemplateUpper.".php";
        $newFilePath= $this->remplace($fileModel);

        if(File::copy($fileModel, $newFilePath)){
            $this->remplaceFile($newFilePath);
            $this->info("File duplicated: {$newFilePath}");
        }

    }

    protected function createProvider()
    {

        $fileModel=app_path()."/Providers/".$this->pluralTemplateUpper."Provider.php";
        $newFilePath= $this->remplace($fileModel);

        if(File::copy($fileModel, $newFilePath)){
            $this->remplaceFile($newFilePath);
            $this->info("File duplicated: {$newFilePath}");
        }
    }


    protected function remplace($cad)
    {
        if(count($this->remplaces)>0) {
            foreach ($this->remplaces as $search => $remplace) {
                $cad=str_replace($search,$remplace,$cad);
            }
        }

        return $cad;
    }

    protected function remplaceFile($file)
    {

        if(File::exists($file)) {
            $content = File::get($file);

            if (count($this->remplaces) > 0) {
                foreach ($this->remplaces as $search => $remplace) {
                    $content = str_replace($search, $remplace, $content);
                }
            }

            File::put($file, $content);
        }
    }
}