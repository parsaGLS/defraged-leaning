<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class TaskForm extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    public string $label='';
    public string $description='';
    public int $status=self::STATUS_INACTIVE;


    public static array $exported;

    public function setStatus($ids)
    {

        $ids=$this->doneStatusId($ids);


        $tableName = $this->tableName();

        $sql='UPDATE '.$tableName.' SET status = 0 ';
        $statement = Application::$app->db->pdo->prepare($sql);
        $statement->execute();
        if (empty($ids)){
            return true;
        }


        $sql='UPDATE '.$tableName.' SET status = 1 WHERE id IN ( '.implode(',', $ids)  .')';

        $statement = Application::$app->db->pdo->prepare($sql);
        $statement->execute();

        return true;




    }

    public function doneStatusId($ids): array
    {
        $result=[];
        foreach ($ids as $key => $id) {
            $arr=explode('-',$key);

            if ($arr[1]==='done'){

                $result[]=$arr[0];
            }




        }
        return $result;
    }
    public function delete($ids)
    {
        $ids=$this->deleteId($ids);
        if (empty($ids)){
            return true;
        }
        $tableName = $this->tableName();

        $sql='DELETE FROM '.$tableName.' WHERE id IN ('.implode(',', $ids)  .')';
        $statement = Application::$app->db->pdo->prepare($sql);
        $statement->execute();
        return true;
    }
    public function deleteId ($ids): array
    {
        $result=[];
        foreach ($ids as $key => $id) {
            $arr=explode('-',$key);

            if ($arr[1]==='delete'){

                $result[]=$arr[0];
            }
        }
        return $result;
    }


    public function export()
    {
        $tableName = static::tableName();
        $statement = Application::$app->db->pdo->prepare("SELECT * FROM $tableName");
        $statement ->execute();
        $result= $statement->fetchAll();
        //return as array
        self::$exported = $result;
        return $result;
    }



    public function rules(): array
    {
        return [
            'label'=>[self::RULE_REQUIRED],
            'description'=>[self::RULE_REQUIRED],
        ];
    }
    public function tableName(): string
    {
        return 'tasks';
    }
    public function primaryKey():string
    {
        return 'id';

    }

    public function attributes():array
    {
        return ['label','description','status'];
    }




    public function save()
    {
        $this->status = self::STATUS_INACTIVE;


        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = Application::$app->db->pdo->prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ")
         VALUES (" . implode(',', $params) . ")");


        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->$attribute);
        }
        $statement->execute();
        return true;

    }
    public function labels(): array
    {
        return [
            'label' => 'Label',
            'description' => 'Description'

        ];
    }






}