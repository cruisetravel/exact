<?php

namespace AppBundle\DataTransformer;

use Symfony\Component\DomCrawler\Crawler;

/**
 * ExactAnwbGolfTransformer.
 *
 * @author wicliff <wic@cruisetravel.nl>
 */
class ExactAnwbGolfTransformer
{
    /**
     * @var array
     */
    private $values = [];

    /**
     * @var array
     */
    private $csv = [];

    /**
     * @var array
     */
    private $columns = [
        'regelnummer',
        'dagb_type',
        'dagbknr',
        'periode',
        'bkjrcode',
        'bkstnr',
        'oms25',
        'Date',
        'reknr',
        'debnr',
        'crdnr',
        'faktuurnr',
        'bedrag',
        'Empty',
        'valcode',
        'koers',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'btw_code',
        'btw_bdr',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'kstplcode',
        'kstdrcode',
        'aantal',
        'Empty',
        'Empty',
        'transsubtype',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
        'Empty',
    ];

    /**
     * Transform.
     *
     * @param string $xml
     *
     * @return string
     */
    public function transform($xml)
    {
        $crawler = new Crawler($xml);
        $this->invalid = array();
  
        //$this->csv[] =  '"'. implode('","', $this->columns) . '"';

        $crawler->filter('GLEntry')->each(function (Crawler $node, $i) {
            //Reset the lines array
            $this->values = array();

            $node->filter('FinEntryLine')->each(function (Crawler $nodeValues, $index) use ($node) {
                $k = $index + 1;
                $values = $nodeValues;
                //ANWB Golf processes invoices with the invoicedate = the day of import
                $today = new \DateTime();
            
                $this->values[$k] = array_fill(0, 40, '');

                $this->values[$k][0] = $k;
                $this->values[$k][1] = $node->filter('Journal')->attr('type');
                $this->values[$k][2] = $node->filter('Journal')->attr('code'); 
                $this->values[$k][3] = $today->format('m');
                $this->values[$k][4] = $today->format('Y');
                $this->values[$k][5] = '';
                $this->values[$k][6] = $values->filter('Description')->text();

                if (0 === $index) {
                    //Headerline settings
                    $this->values[0] = array_fill(0, 40, '');
                    $this->values[0][0] = 0;
                    $this->values[0][1] = $node->filter('Journal')->attr('type');
                    $this->values[0][2] = $node->filter('Journal')->attr('code'); 
                    $this->values[0][3] = $today->format('m');
                    $this->values[0][4] = $today->format('Y');
                    $this->values[0][5] = $node->attr('entry');
                    $this->values[0][6] = $node->filter('Description')->text() . " " . $values->filter('Debtor')->attr('code');
                    $this->values[0][7] = $today->format('dmY');
                    $this->values[0][9] = $values->filter('Debtor')->attr('code');
                    $this->values[0][24] = '4'; //Golf uses direct debit on all customers

                    $this->csv[] = '"'. implode('","', $this->values[0]) . '"';
                }

                $date = new \DateTime();

                //Define whether it is an debit or credit amount
                if (($values->filter('Amount > Credit')->count())) {
                    $amount = $values->filter('Amount > Credit')->text();
                } else {
                    $amount = "-".$values->filter('Amount > Debit')->text();
                }

                if (($values->filter('Amount > VAT')->count())) {
                    $vat = $values->filter('Amount > VAT')->attr('code');
                } else {
                    $vat = "";
                }
                
                $this->values[$k][7] = $date->format('dmY');
                $this->values[$k][8] = $values->filter('GLAccount')->attr('code');
                $this->values[$k][9] = $values->filter('Debtor')->attr('code');
                $this->values[$k][11] = $node->attr('entry');
                $this->values[$k][12] = str_replace(".", ",", $amount);
                $this->values[$k][14] = '1';
                $this->values[$k][15] = '1';
                $this->values[$k][20] = $vat;
                $this->values[$k][21] = 0;
                $this->values[$k][28] = 0;
                $this->values[$k][31] = '';
                $this->csv[] = '"'. implode('","', $this->values[$k]) . '"';
            });
        });

  
  return implode("\r\n", $this->csv);
    }
}
