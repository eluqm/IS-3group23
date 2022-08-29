<?php
namespace IS3group3\Tests\Pregunta\Models;

use IS3group3\Tests\Pregunta\DatabaseTestCase;
use IS3group3\Models\Pregunta;

class PreguntaModelsTest extends DatabaseTestCase
{
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/../../Fixtures/pregunta_test.xml');
    }
    public function test_register()
    {
        $preguntaModel = new Pregunta();
        $data = [
            'titulo' => 'HII',
            'descripcion' => 't1',
            'curso' => '20212200',
            'tema' => 'T1',
            'cui' => 22122344,
            'fecha_limite' => '2022-08-03 22:19:45',
            'disponibilidad' => 'd1'
        ];
        $preguntaModel->register($data);
        $id_question = $preguntaModel->find_id_by_tittle('HII');
        
        
        $this->assertNotNull($id_question[0]->id);
        $findPregunta = $preguntaModel->findQuestionById_2($id_question[0]->id);
        $this->assertEquals( 'HII', $findPregunta[0]->titulo);
        $this->assertEquals( 't1' , $findPregunta[0]->descripcion);
        $this->assertEquals( '20212200' , $findPregunta[0]->curso);
        $this->assertEquals( 'T1' , $findPregunta[0]->tema);
        $this->assertEquals( '22122344' , $findPregunta[0]->cui_usuario);
        $this->assertEquals( '2022-08-03 22:19:45' , $findPregunta[0]->fecha_limite);
        $this->assertEquals( 'd1' , $findPregunta[0]->cui_mentor);
        $this->assertEquals( 'NULL' , $findPregunta[0]->fecha_meet);
        $this->assertEquals( 'NULL' , $findPregunta[0]->link_meet);
        $this->assertEquals( 'NULL' , $findPregunta[0]->reunion_privada);
        $this->assertEquals( 'NULL' , $findPregunta[0]->max_participantes);
        $this->assertEquals( 'NULL' , $findPregunta[0]->cupos_disponibles);
    }
    public function test_register_in_non_rejected()
    {
        $preguntaModel = new Pregunta();
        $id_question = 10;
        $preguntaModel->register_in_non_rejected($id_question);
                
        $this->assertNotNull($id_question);
        $findPregunta = $preguntaModel->is_rechazada($id_question);
        $this->assertEquals( '10', $findPregunta[0]->id);
    }
    public function test_get_all_by_curso()
    {
        $preguntaModel = new Pregunta();

        
        $getQtions = $preguntaModel->get_all_by_curso( 'Ingenieria de Software I' );
        $this->assertEquals( 7, $getQtions[0]->id );
        $this->assertEquals( 'Nav bien distribuido con CSS', $getQtions[0]->titulo );
        $this->assertEquals( 'd2', $getQtions[0]->descripcion );
        $this->assertEquals( '1703132', $getQtions[0]->curso );
        $this->assertEquals( 't2', $getQtions[0]->tema );
        $this->assertEquals( '2022-06-13 21:56:03', $getQtions[0]->fecha_publicacion );
        $this->assertEquals( '20202995', $getQtions[0]->cui_usuario );
        $this->assertEquals( 'disp1', $getQtions[0]->disponibilidad );
        $this->assertEquals( '0', $getQtions[0]->estado );
        $this->assertEquals( '2022-08-03 22:19:45', $getQtions[0]->fecha_limite );
        $this->assertEquals( 'NULL', $getQtions[0]->cui_mentor );
        $this->assertEquals( 'NULL', $getQtions[0]->fecha_meet );
        $this->assertEquals( 'NULL', $getQtions[0]->link_meet );
        $this->assertEquals( 'NULL', $getQtions[0]->reunion_privada );
        $this->assertEquals( 'NULL', $getQtions[0]->max_participantes );
        $this->assertEquals( 'NULL', $getQtions[0]->cupos_disponibles );
        
        $this->assertNull( $getQtions );
    }
    public function test_findQuestionById()
    {
        $preguntaModel = new Pregunta();
        $getQtions = $preguntaModel->findQuestionById_2(6);
        $this->assertEquals( '¿Cómo puedo seleccionar un Input en específico si tengo varios con el mismo nombre?', $getQtions[0]->titulo);
        $this->assertEquals( 'd2' , $getQtions[0]->descripcion);
        $this->assertEquals( '1703130' , $getQtions[0]->curso);
        $this->assertEquals( 't2' , $getQtions[0]->tema);
        $this->assertEquals( '22122344' , $getQtions[0]->cui_usuario);
        $this->assertEquals( '2022-08-03 22:19:45' , $getQtions[0]->fecha_limite);
        $this->assertEquals( 'd1' , $getQtions[0]->cui_mentor);
        $this->assertEquals( 'NULL' , $getQtions[0]->fecha_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->link_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->reunion_privada);
        $this->assertEquals( 'NULL' , $getQtions[0]->max_participantes);
        $this->assertEquals( 'NULL' , $getQtions[0]->cupos_disponibles);
        
        $this->assertNull( $getQtions );
    }
    public function test_edit()
    {
        $preguntaModel = new Pregunta();

        $getQtions = $preguntaModel->findQuestionById_2(6);
        $this->assertEquals( '¿Cómo puedo seleccionar un Input en específico si tengo varios con el mismo nombre?', $getQtions[0]->titulo);
        $this->assertEquals( 'd2' , $getQtions[0]->descripcion);
        $this->assertEquals( '1703130' , $getQtions[0]->curso);
        $this->assertEquals( 't2' , $getQtions[0]->tema);
        $this->assertEquals( '22122344' , $getQtions[0]->cui_usuario);
        $this->assertEquals( '2022-08-03 22:19:45' , $getQtions[0]->fecha_limite);
        $this->assertEquals( 'd1' , $getQtions[0]->cui_mentor);
        $this->assertEquals( 'NULL' , $getQtions[0]->fecha_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->link_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->reunion_privada);
        $this->assertEquals( 'NULL' , $getQtions[0]->max_participantes);
        $this->assertEquals( 'NULL' , $getQtions[0]->cupos_disponibles);


        $data = [
            'id' => '6',
            'titulo' => 'I WNAT MORE',
            'descripcion' => 'GUY',
            'curso' => '1702225',
            'tema' => 'FArhenheit',
            'cui' => 22122344,
            'fecha_limite' => '2022-08-15 20:17:45',
            'disponibilidad' => 'I donowt know'
        ];
        $preguntaModel->edit($data);
        
        $getQtions = $preguntaModel->findQuestionById_2(6);
        $this->assertEquals( 'I WNAT MORE', $getQtions[0]->titulo);
        $this->assertEquals( 'GUY' , $getQtions[0]->descripcion);
        $this->assertEquals( '1702225' , $getQtions[0]->curso);
        $this->assertEquals( 'FArhenheit' , $getQtions[0]->tema);
        $this->assertEquals( '22122344' , $getQtions[0]->cui_usuario);
        $this->assertEquals( '2022-08-15 22:19:45' , $getQtions[0]->fecha_limite);
        $this->assertEquals( 'I donowt know' , $getQtions[0]->cui_mentor);
        $this->assertEquals( 'NULL' , $getQtions[0]->fecha_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->link_meet);
        $this->assertEquals( 'NULL' , $getQtions[0]->reunion_privada);
        $this->assertEquals( 'NULL' , $getQtions[0]->max_participantes);
        $this->assertEquals( 'NULL' , $getQtions[0]->cupos_disponibles);
    }
    public function test_delete()
    {
        $preguntaModel = new Pregunta();

        $preguntaModel->delete(10);

        $getQtion = $preguntaModel->findQuestionById_2(10);
        
        $this->assertNull( $getQtion );
    }
}
?>