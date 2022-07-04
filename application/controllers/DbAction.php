<?php
require_once( FCPATH .'application/libraries/excel_reader2.php');

class DbAction extends CI_Controller
{

    public function importExcel()
    {
        
        $data = new Spreadsheet_Excel_Reader( FCPATH . "data-excel.xls");
        for($i=0;$i<5;$i++)
        {
            $baris = $data->rowcount($sheet_index=$i);
            
            $bencanaId = ($i+1);
            $bencana = $this->db->get_where('m_bencana', ['id' => $bencanaId])->row();
            
           
            for ($j=2; $j<=$baris; $j++){

                $kelurahan = $data->val($j, 2, $i);
                $arrBang = explode(" ",$data->val($j, 5, $i));
                $nilaiBang = str_replace(",",".",$arrBang[0]);
                $arrFask = explode(" ",$data->val($j, 6, $i));
                $nilaiFas = str_replace(",",".",$arrFask[0]);
                
                $dtBn = [
                    'bencana' => $data->val($j, 3, $i),
                    'populasi' => $data->val($j, 4, $i),
                    'bangunan' => $nilaiBang != " " ? $nilaiBang : 0,
                    'faskes' => $nilaiFas != " " ? $nilaiFas : 0
                ];

                #echo '['.$bencana->nama.'] Baris : => '.$baris.' data => '. json_encode($dtBn);
                #echo '<br>';

                $kel = $this->db->select('id_kelurahan')->get_where('m_kelurahan', ['nama' => $kelurahan])->row();
                if($kel)
                {
                    echo '[index'.$i.']'. $kel->id_kelurahan. ': '. $kelurahan;
                    echo '<br>';

                    $pemetaan = $this->db->select('id')->get_where('pemetaan_bencana', ['kelurahan_id' => $kel->id_kelurahan])->row();
                    if( $pemetaan )
                    {
                        $detailP = $this->db->select('id')->get_where('pemetaan_bencana_detail', ['pemetaan_id' => $pemetaan->id, 'bencana_id' => $bencanaId])->row();
                        if( $detailP )
                        {
                            $this->db->where('id', $detailP->id);
                            $this->db->update('pemetaan_bencana_detail', $dtBn);
                            
                            echo 'Success update id_pemetaan_detail = '. $detailP->id . ' data = '. json_encode($dtBn);
                            echo '<br>';
                        }
                    }
                }else{
                    echo '[index'.$i.'] Kelurahan '. $kelurahan. ' not found';
                    echo '<br>';
                }

            }
        }
        
        
    }
}