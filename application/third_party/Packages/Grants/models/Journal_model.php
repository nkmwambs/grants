<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *	@author 	: Nicodemus Karisa
 *	@date		: 27th September, 2018
 *	Finance management system for NGOs
 *	https://techsysnow.com
 *	NKarisa@ke.ci.org
 */

class Journal_model extends MY_Model implements CrudModelInterface, TableRelationshipInterface
{
  public $table = 'journal'; // you MUST mention the table name
  public $primary_key = 'journal_id'; // you MUST mention the primary key
  public $fillable = array(); // If you want, you can set an array with the fields that can be filled by insert/update
  public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
  public $hidden_columns = array();

  function __construct(){
    parent::__construct();
    $this->load->database();

  }

  function index(){

  }

  public function lookup_tables(){
    return ['office'];
  }

  public function detail_tables(){}

  public function table_visible_columns(){}

  public function table_hidden_columns(){}

  public function master_table_visible_columns(){}

  public function master_table_hidden_columns(){}

  public function list(){
    
  }

  public function view(){}

  function month_opening_bank_balance(){
    return 2345900.12;
  }

  function month_opening_cash_balance(){
    return 4510.00;
  }

  function get_office_data_from_journal(){
    $journal_id = hash_id($this->id,'decode');

    $this->db->select(array('office_id','office_name','journal_id','journal_month'));
    $this->db->join('journal','journal.fk_office_id=office.office_id');
    $this->db->where(array('journal_id'=>$journal_id));
    $row  = $this->db->get('office')->row();

    return $row;
  } 

  private function navigate_month_journal($office_id, $transacting_month,$direction = 'next'){

      $journal = null;

      $direction_phrase = 'first day of next month';

      if($direction == 'previous'){
        $direction_phrase = 'first day of last month';
      }

      $month = date('Y-m-01',strtotime($direction_phrase,strtotime($transacting_month)));
      $journal_obj = $this->db->get_where('journal',
      array('journal_month'=>$month,'fk_office_id'=>$office_id));

      if($journal_obj->num_rows()>0){
        $journal = $journal_obj->row();
      }

      return $journal;
  }


  function journal_navigation($office_id, $transacting_month){

      $prev = $this->navigate_month_journal($office_id, $transacting_month,'previous');
      $next = $this->navigate_month_journal($office_id, $transacting_month,'next');

      $prev = $prev != null?$prev->journal_id:null;
      $next = $next != null?$next->journal_id:null;

      return ['previous'=>$prev,'next'=>$next];
  }

  function financial_accounts(){
    return [
      'income'=>[1=>'R100',2=>'R200',3=>'R300'],
      'expense'=>[1=>'E001',2=>'E002',3=>'E003',4=>'E004',5=>'E005'],
    ];
  }
  

  function journal_records($office_id){
    return [
              '1'=>[
                  'date'=>'2019-11-01',
                  'payee'=>'Various',
                  'voucher_type_abbrev'=>'PCE',
                  'voucher_type_name'=>'Payment by Cash',
                  'voucher_type_cash_account'=>'cash',
                  'voucher_type_transaction_effect'=>'expense',
                  'voucher_number'=>'191101',
                  'description'=>'Facilitation Wages',
                  'cleared'=>true,
                  'cheque_number'=>0,
                  'voucher_amount'=>1800.00,
                  'spread'=>[
                      ['account_id'=>1,'transacted_amount'=>200.00],
                      ['account_id'=>3,'transacted_amount'=>800.00],
                      ['account_id'=>3,'transacted_amount'=>800.00],
                    ]
              ],
              '2'=>[
                  'date'=>'2019-11-03',
                  'payee'=>'Various',
                  'voucher_type_abbrev'=>'BCR',
                  'voucher_type_name'=>'Bank Cash Received',
                  'voucher_type_cash_account'=>'bank',
                  'voucher_type_transaction_effect'=>'income',
                  'voucher_number'=>'191102',
                  'description'=>'Grants income',
                  'cleared'=>false,
                  'cheque_number'=>0,
                  'voucher_amount'=>345000.00,
                  'spread'=>[
                    ['account_id'=>1,'transacted_amount'=>300000.00],
                    ['account_id'=>3,'transacted_amount'=>45000.00],
                  ]
              ],
                  
              '3'=>[
                   'date'=>'2019-11-05',
                   'payee'=>'Various',
                   'voucher_type_abbrev'=>'CHQ',
                   'voucher_type_name'=>'Bank payment',
                   'voucher_type_cash_account'=>'bank',
                   'voucher_type_transaction_effect'=>'expense',
                   'voucher_number'=>'191103',
                   'description'=>'Payment of salaries',
                   'cleared'=>false,
                   'cheque_number'=>201,
                   'voucher_amount'=>54000.00,
                   'spread'=>[
                      ['account_id'=>2,'transacted_amount'=>10000.00],
                      ['account_id'=>1,'transacted_amount'=>15000.00],
                      ['account_id'=>1,'transacted_amount'=>20000.00],
                      ['account_id'=>4,'transacted_amount'=>5000.00],
                    ]
                  ],
              '4'=>[
                      'date'=>'2019-11-05',
                      'payee'=>'Various',
                      'voucher_type_abbrev'=>'CTP',
                      'voucher_type_name'=>'Petty Cash Top Up',
                      'voucher_type_cash_account'=>'cash',
                      'voucher_type_transaction_effect'=>'contra',
                      'voucher_number'=>'191104',
                      'description'=>'Petty Cash Imprest',
                      'cleared'=>true,
                      'cheque_number'=>202,
                      'voucher_amount'=>54000.00,
                      'spread'=>[]
                ],
                '5'=>[
                        'date'=>'2019-11-08',
                        'payee'=>'Various',
                        'voucher_type_abbrev'=>'BCHG',
                        'voucher_type_name'=>'Bank Charges',
                        'voucher_type_cash_account'=>'bank',
                        'voucher_type_transaction_effect'=>'expense',
                        'voucher_number'=>'191105',
                        'description'=>'Bank Charges',
                        'cleared'=>true,
                        'cheque_number'=>0,
                        'voucher_amount'=>540.00,
                        'spread'=>[
                            ['account_id'=>2,'transacted_amount'=>540.00],
                          ]
                      ],
                  '6'=>[
                          'date'=>'2019-11-12',
                          'payee'=>'Various',
                          'voucher_type_abbrev'=>'BIT',
                          'voucher_type_name'=>'Bank Interest Receiveable',
                          'voucher_type_cash_account'=>'bank',
                          'voucher_type_transaction_effect'=>'income',
                          'voucher_number'=>'191106',
                          'description'=>'Interest Received',
                          'cleared'=>false,
                          'cheque_number'=>0,
                          'voucher_amount'=>2451.67,
                          'spread'=>[
                            ['account_id'=>2,'transacted_amount'=>10000.00],
                          ]
                        ],
                          '7'=>[
                            'date'=>'2019-11-15',
                            'payee'=>'Various',
                            'voucher_type_abbrev'=>'PCR',
                            'voucher_type_name'=>'Petty Cash Income',
                            'voucher_type_cash_account'=>'cash',
                            'voucher_type_transaction_effect'=>'income',
                            'voucher_number'=>'191107',
                            'description'=>'Income from farm sales to Amani traders, Mukuyu groceries and Kept Shopping mall',
                            'cleared'=>false,
                            'cheque_number'=>0,
                            'voucher_amount'=>12800.00,
                            'spread'=>[
                                ['account_id'=>2,'transacted_amount'=>6000.00],
                                ['account_id'=>1,'transacted_amount'=>6800.00],
                              ]
  
                            ],
                            '8'=>[
                              'date'=>'2019-11-20',
                              'payee'=>'Various',
                              'voucher_type_abbrev'=>'PCRB',
                              'voucher_type_name'=>'Petty Cash Rebanking',
                              'voucher_type_cash_account'=>'bank',
                              'voucher_type_transaction_effect'=>'contra',
                              'voucher_number'=>'191108',
                              'description'=>'Petty Cash rebanking',
                              'cleared'=>true,
                              'cheque_number'=>0,
                              'voucher_amount'=>21000.00,
                              'spread'=>[]
                          ]

          ];
  }
}
