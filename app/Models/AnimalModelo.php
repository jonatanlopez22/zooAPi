<?php namespace App\Models;

use CodeIgniter\Model;

class AnimalModelo extends Model{
    protected $table      = 'animales';
    protected $primaryKey = 'idanimal';
    protected $allowedFields = ['idanimal', 'nombre', 'edad', 'tipo', 'descripcion', 'comida'];

}