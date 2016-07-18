<?php

namespace AppBundle\DataTransformer;

use Symfony\Component\DomCrawler\Crawler;

/**
 * ExactTransformer.
 *
 * @author wicliff <wic@cruisetravel.nl>
 */
class ExactTransformer
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

        //$this->csv[] =  '"'. implode('","', $this->columns) . '"';

        $crawler->filter('BankJournalEntry')->each(function (Crawler $node, $i) {
            $k = $i + 1;
            
	    $values = $node->filter('BankJournalEntryLine > Values');

            if (!empty($payRef = $values->filter('MdimCode1')->count())) {
                $payRef = $values->filter('MdimCode1')->text();
                $payRefArr = explode("/", $payRef);

                $reservationNumber = $payRefArr[1];
                $payment = ((float) $values->filter('AmountDc')->text() * -1);
            } elseif (!empty($payRef = $values->filter('OutstItemEntryNr')->count())) {
                $reservationNumber = $values->filter('OutstItemEntryNr')->text();
                $payment = ((float) $values->filter('AmountDc')->text() * -1);
            } else {
                $reservationNumber = "";
                $payment = "0.00";
            }

            //For banktransaction we only need one line so reset the line
            if ($values->filter('AccNr')->text() == "1531") {
                $reservationNumber = "";
                $payment = "0.00";
            }
            
            $this->values[$k] = array_fill(0, 40, '');

            $this->values[$k][0] = $k;
            $this->values[$k][1] = 'B';
            $this->values[$k][2] = '17'; //$node->attr('journalNr');
            $this->values[$k][3] = $node->attr('period');
            $this->values[$k][4] = $node->attr('finYr');
            $this->values[$k][5] = '';
            $this->values[$k][6] = $node->filter('Values > Descr')->text();

            if (0 === $i) {
		$today = new \DateTime();
		
                $this->values[$i] = array_fill(0, 40, '');
                $this->values[$i][0] = 0;
		$this->values[$i][1] = 'B';
		$this->values[$i][2] = '17'; 
                $this->values[$i][3] = $today->format('m');
                $this->values[$i][4] = $today->format('Y');
		$this->values[$i][5] = $node->filter('Values > EntryNr')->text();
                $this->values[$i][6] = $node->filter('Values > Descr')->text();
                $this->values[$i][7] = $today->format('dmY');
		$this->values[$i][24] = 'B';

                $this->csv[] = '"'. implode('","', $this->values[$i]) . '"';
            }

            $date = new \DateTime($values->filter('DateLine')->text());

            $this->values[$k][7] = $date->format('dmY');
            $this->values[$k][8] = ($values->filter('AccNr')->text() == "1123" ? "3213" : $values->filter('AccNr')->text());
            $this->values[$k][9] = $values->filter('DebtorLine')->text();
            $this->values[$k][11] = $reservationNumber;
            $this->values[$k][12] = $payment;
            $this->values[$k][14] = $values->filter('OutstItemCurrCode')->text();
            $this->values[$k][15] = '1';
            $this->values[$k][20] = 0;
            $this->values[$k][21] = 0;
            $this->values[$k][28] = 0;
            $this->values[$k][31] = 'P';
            $this->csv[] = '"'. implode('","', $this->values[$k]) . '"';
        });

        return implode("\r\n", $this->csv);
    }
}
