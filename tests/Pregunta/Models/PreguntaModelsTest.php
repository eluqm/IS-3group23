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
        $id_question = $preguntaModel->find_id_by_tittle('Hii');
        
        $this->assertNotNull($id_question->id);
        $findPregunta = $preguntaModel->findQuestionById($id_question);
        $this->assertEquals( 'HII', $findPregunta->titulo);
        $this->assertEquals( 't1' , $findPregunta->descripcion);
        $this->assertEquals( '20212200' , $findPregunta->curso);
        $this->assertEquals( 'T1' , $findPregunta->tema);
        $this->assertEquals( '22122344' , $findPregunta->cui_usuario);
        $this->assertEquals( '2022-08-03 22:19:45' , $findPregunta->fecha_limite);
        $this->assertEquals( 'd1' , $findPregunta->disponibilidad);
    }
    public function test_register_in_non_rejected()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
    public function test_get_all_by_curso()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
    public function test_findQuestionById()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
    public function test_edit()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
    public function test_delete()
    {
        $this->markTestIncomplete( 'Not written yet.' );
    }
}
?>