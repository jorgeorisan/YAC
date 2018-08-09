<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Administracion extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        /* Standard Libraries */
        $this->load->database();
        $this->load->helper('url');
        /* ------------------ */

        //$this->load->add_package_path(APPPATH . 'third_party/grocery_crud/');

        //$this->output->set_template('datatables');

        $this->load->library('grocery_CRUD');
    }

    function index()
    {

    }

    function _example_output($output = null)
    {
        $this->load->view('example.php', $output);
    }

    function empresa()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function cascada()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);

    }


    function cuenta()
    {
        $crud = new grocery_CRUD();

        //        $crud->set_table('cuenta');
        $crud->display_as('id_empresa', 'Empresa');
        //        $crud->set_subject('Employee');

        $crud->set_relation('id_empresa', 'empresa', 'nombre');

        $crud->render();
    }

    function gasto()
    {
        $crud = new grocery_CRUD();


        $output = $crud->render();

        $this->_example_output($output);
    }



    function materia_prima()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function producto()
    {
        $crud = new grocery_CRUD();
        $crud->set_relation('id_categoria', 'categoria', 'id_categoria');
        $crud->set_relation('id_cascada', 'cascada', 'nombre');
        $output = $crud->render();

        $this->_example_output($output);
    }

    function usuario()
    {
        $crud = new grocery_CRUD();


        $crud->set_relation('id_usuario_tipo', 'usuario_tipo', 'id_usuario_tipo');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function producto_has_materia_prima()
    {
        $crud = new grocery_CRUD();

        $crud->display_as('id_producto', 'Producto');
        $crud->display_as('id_materia_prima', 'Materia prima');

        $crud->set_relation('id_producto', 'producto', 'nombre');
        $crud->set_relation('id_materia_prima', 'materia_prima', 'nombre');

        $output = $crud->render();

        $this->_example_output($output);
    }

    function categoria()
    {
        $output = $this->grocery_crud->render();

        $this->_example_output($output);
    }

    function producto_has_categoria()
    {
        $crud = new grocery_CRUD();

        $crud->display_as('id_producto', 'Producto');
        $crud->display_as('id_categoria', 'Categoría');

        $crud->set_relation('id_producto', 'producto', 'nombre');
        $crud->set_relation('id_categoria', 'categoria', 'id_categoria');


        $output = $crud->render();

        $this->_example_output($output);
    }


}