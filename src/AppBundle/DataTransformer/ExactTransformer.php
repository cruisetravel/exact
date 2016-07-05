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

        $this->csv[] = implode(',', $this->columns);

        $crawler->filter('BankJournalEntry')->each(function (Crawler $node, $i) {
            $k = $i + 1;
            $values = $node->filter('BankJournalEntryLine > Values');
            $this->values[$k] = array_fill(0, 40, '');

            $this->values[$k][0] = $k;
            $this->values[$k][1] = (93 === (int) $node->attr('journalnr')) ? 'M' : 'B';
            $this->values[$k][2] = $node->attr('journalnr');
            $this->values[$k][3] = $node->attr('period');
            $this->values[$k][4] = $node->attr('finyr');
            $this->values[$k][5] = $node->filter('Values > EntryNr')->text();
            $this->values[$k][6] = $node->filter('Values > Descr')->text();

            if (0 === $i) {
                $this->values[$i] = array_fill(0, 40, '');
                $this->values[$i][0] = 0;
                $this->values[$i][6] = $node->filter('Values > Descr')->text();
                $this->values[$i][23] = 'B';

                $this->csv[] = implode(',', $this->values[$i]);
            }

            $date = new \DateTime($values->filter('DateLine')->text());

            $this->values[$k][7] = $date->format('d-m-Y');
            $this->values[$k][8] = $values->filter('AccNr')->text();
            $this->values[$k][9] = $values->filter('DebtorLine')->text();
            $this->values[$k][11] = $values->filter('OutstItemEntryNr')->text();
            $this->values[$k][12] = $values->filter('AmountDc')->text();
            $this->values[$k][14] = $values->filter('OutstItemCurrCode')->text();
            $this->values[$k][15] = '';
            $this->values[$k][20] = 0;
            $this->values[$k][21] = 0;
            $this->values[$k][28] = 0;
            $this->values[$k][31] = 'P';

            $this->csv[] = implode(',', $this->values[$k]);
        });

        return implode("\n", $this->csv);
    }
}
