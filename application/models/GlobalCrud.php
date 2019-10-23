<?php

class GlobalCrud extends CI_Model {
    
    function all($table){
        return $this->db->get($table);
    }
    
    function get($table,$query){
        return $this->db->get_where($table,$query);
    }
    
    function insert($table,$query){
        $this->db->insert($table,$query);
    }
    
    function delete($table,$column,$id){
        $this->db->where($column,$id);
        $this->db->delete($table);
    }
    
    function update($table,$query,$column,$id){
        $this->db->where($column,$id);
        $this->db->update($table,$query);
    }
    
    function count_table($table){
        return $this->db->count_all($table);
    }
    
    function twoTablesFusion($table1,$table2,$select,$clause){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause);
        return $this->db->get();
    }

    function twoTablesFusionCondition($table1,$table2,$select,$clause,$condition,$where){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause);
        $this->db->where($condition,$where);
        return $this->db->get();
    }

    function threeTablesFusionCondition($table1,$table2,$table3,$select,$clause1,$clause2,$condition,$where){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause1);
        $this->db->join($table3,$clause2);
        $this->db->where($condition,$where);
        return $this->db->get();
    }  

    function fourTablesFusionCondition($table1,$table2,$table3,$table4,$select,$clause1,$clause2,$clause3,$condition,$where){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause1);
        $this->db->join($table3,$clause2);
        $this->db->join($table4,$clause3);
        $this->db->where($condition,$where);
        return $this->db->get();
    } 

    function fiveTablesFusionCondition($table1,$table2,$table3,$table4,$table5,$select,$clause1,$clause2,$clause3,$clause4,$condition,$where){
        $this->db->select($select);
        $this->db->from($table1);
        $this->db->join($table2,$clause1);
        $this->db->join($table3,$clause2);
        $this->db->join($table4,$clause3);
        $this->db->join($table5,$clause4);
        $this->db->where($condition,$where);
        return $this->db->get();
    }   

    /* custom query */
    function delete_pendaftar($id_registrasi){
        $this->db->where('id_registrasi',$id_registrasi);
        $this->db->delete('registrasi');
    }     
    
    function get_desc($table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->order_by('id_registrasi', 'DESC');
        $this->db->limit('1');
        return $this->db->get()->row();
    }

    function delete_nilai($id_registrasi){
        $this->db->where('id_registrasi',$id_registrasi);
        $this->db->delete('nilai');
    }  

    function groupBy($table){
        $this->db->select('id_ekskul');
        $this->db->from($table);
        $this->db->group_by('id_ekskul');
        return $this->db->get();
    }  
    
    function groupByRegister(){
        $this->db->select('count(r.id_siswa) as jumlah_siswa, e.nama_ekskul as ekskul');
        $this->db->from('registrasi r');
        $this->db->join('ekskul e', 'e.id_ekskul = r.id_ekskul');
        $this->db->group_by('r.id_ekskul');
        return $this->db->get();
    } 

    function groupByEkskul($id){
        $this->db->select('s.nama_siswa as siswa, e.nama_ekskul as ekskul');
        $this->db->from('registrasi r');
        $this->db->join('ekskul e', 'e.id_ekskul = r.id_ekskul');
        $this->db->join('siswa s', 's.id_siswa = r.id_siswa');
        $this->db->where('r.id_ekskul', $id);
        return $this->db->get();
    }

    function groupByPendaftar($id_ekskul){
        $this->db->select(' s.id_siswa,
                            s.nama_siswa ,
                            s.nis as nis,
                            s.kelas ,
                            s.jurusan ,
                            s.rombel,
                            r.tanggal_daftar,
                            e.id_ekskul,
                            n.nilai,
                            n.id_nilai ,
                            r.id_registrasi');
        $this->db->from('registrasi r');
        $this->db->join('ekskul e', 'e.id_ekskul = r.id_ekskul');
        $this->db->join('siswa s', 's.id_siswa = r.id_siswa');
        $this->db->join('nilai n','n.id_registrasi=r.id_registrasi');
        $this->db->where('r.id_ekskul', $id_ekskul);
        return $this->db->get();
        
    }


    public function title()
    {
                                $this->db->select('e.nama_ekskul');
                                 $this->db->from('ekskul e');
                                 $this->db->join('registrasi r', 'r.id_ekskul = e.id_ekskul'); 
                                 $this->db->where('e.id_ekskul');
                                 return $this->db->get();
                                 
    }




}