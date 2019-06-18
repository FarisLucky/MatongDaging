<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'assets/library/dompdf/autoload.inc.php';
/**
 * CodeIgniter DomPDF Library
 *
 * Generate PDF's from HTML in CodeIgniter
 *
 * @packge        CodeIgniter
 * @subpackage        Libraries
 * @category        Libraries
 * @author        Ardianta Pargo
 * @license        MIT License
 * @link        https://github.com/ardianta/codeigniter-dompdf
 */
use Dompdf\Dompdf;
class Pdf extends Dompdf{
    /**
     * PDF filename
     * @var String
     */
    public $filename;
    public function __construct(){
        parent::__construct();
    }
    /**
     * Get an instance of CodeIgniter
     *
     * @access    protected
     * @return    void
     */
    protected function ci()
    {
        return get_instance();
    }
    /**
     * Load a CodeIgniter view into domPDF
     *
     * @access    public
     * @param    string    $view The view to load
     * @param    array    $data The view data
     * @return    void
     */
    public function load_view($name,$view, $data = array()){
        $html = $this->ci()->load->view($view, $data, TRUE);

        $this->load_html($html);
        // Set Paper
        $this->setPaper('A4','landscape');
        // Render the PDF
        $this->render();
        // Output the generated PDF to Browser
        $this->stream("$name".".pdf", array("Attachment" => false));
    }
}