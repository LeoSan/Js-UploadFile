<?php
require_once "Zend/Registry.php";

class Remesas_IndexController extends Zend_Controller_Action
{


    //NEW REMESAS


    /**
     * @author Leonard Cuenca <ljcuenca@pendulum.com.mx>
     * @company PENDULUN  C.V
     * @description Permite subir archivo al repositorio
     * @access public
     *
     */
    public function uploadfileAction(){
        try{
            $this->_helper->layout->disableLayout();
            // Define a destination
            $targetFolder =  $_SERVER['DOCUMENT_ROOT']  .  $this->getRequest()->getBaseUrl()."/doc/remesa/acuse/";
            $targetVisual = 'http://doc.pendulum.com.mx/pm/gastos/facturaMasiva/'; //Con este permite ver exactamente donde se debe ver el archivo luego de subirlo
            $params = $this->getRequest()->getParams();
            $fechaFile = date("YmdHis");
            if (!empty($_FILES)) {
                $tempFile = $_FILES['file_recibo']['tmp_name'];
                $targetPath = $targetFolder;
                // Validate the file type
                $fileTypes = array('PDF', 'pdf'); // File extensions
                $fileParts = pathinfo($_FILES['file_recibo']['name']);

                $nombreArchivo = "Acuse_Remesa_" . $fechaFile . "." . $fileParts['extension'];
                $targetFile = rtrim($targetPath,'/') . "/".$nombreArchivo;
                $fileName = $_FILES['file_recibo']['name'];

                if ( in_array( strtolower( $fileParts['extension'] ) , $fileTypes ) ) {

                    $up = move_uploaded_file($tempFile,$targetFile);
                    if( !$up ){
                        throw new Exception("No se pudo mover el archivo: " . $targetFile);
                        $result['valida'] = 'false';
                        $result['msg'] = "No se pudo mover el archivo: " . $targetFile;
                        echo json_encode($result); die();
                    }else{
                        $result['valida'] = 'true';
                        $result['url'] = $targetFile;
                        echo json_encode($result); die();
                    }

                } else {
                    $result['valida'] = 'false';
                    echo json_encode($result);
                    die();
                }
            } else {
                $result['valida'] = 'false';
                echo json_encode($result);
                die();
            }
        } catch( Exception $e) {
            $result['valida'] = 'false';
            $result['msg'] = "Excepción: " . $e->getMessage();
            echo json_encode($result); die();
        }
    }

    public function uploadfileRemesaAction()
    {
        try{
            $this->_helper->layout->disableLayout();
            // Define a destination
//            $targetFolder = "/mnt/file_external/";
//            $targetVisual = 'http://doc.pendulum.com.mx/pm/gastos/facturaMasiva/'; //Con este permite ver exactamente donde se debe ver el archivo luego de subirlo
            $targetFolder =  $_SERVER['DOCUMENT_ROOT']  .  $this->getRequest()->getBaseUrl()."/doc/remesa/acuse/";
            $fechaFile = date("YmdHis");
            if (!empty($_FILES)) {
                $tempFile = $_FILES['file_csv']['tmp_name'];
                $targetPath = $targetFolder;
                // Validate the file type
                $fileTypes = array('CSV', 'csv'); // File extensions
                $fileParts = pathinfo($_FILES['file_csv']['name']);

                $nombreArchivo = "CARGA_MASIVA_REMESA_" . $fechaFile . "." . $fileParts['extension'];
                $targetFile = rtrim($targetPath,'/') . "/".$nombreArchivo;

                if ( in_array( strtolower( $fileParts['extension'] ) , $fileTypes ) ) {

                    $up = move_uploaded_file($tempFile,$targetFile);
                    if( !$up ){
                        throw new Exception("No se pudo mover el archivo: " . $targetFile);
                        $result['valida'] = 'false';
                        $result['msg'] = "No se pudo mover el archivo: " . $targetFile;
                        echo json_encode($result); die();
                    }else{
                        $result['valida'] = 'true';
                        $result['url'] = $targetFile;
                        echo json_encode($result); die();
                    }

                } else {
                    $result['valida'] = 'false';
                    echo json_encode($result);
                    die();
                }
            } else {
                $result['valida'] = 'false';
                echo json_encode($result);
                die();
            }
        } catch( Exception $e) {
            $result['valida'] = 'false';
            $result['msg'] = "Excepción: " . $e->getMessage();
            echo json_encode($result); die();
        }
    }


}