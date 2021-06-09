<?php
class Userz_model extends CI_Model
{
    public function getUserz($userid=null)
    {
        if($userid === null){
            return $this->db->get('users')->result_array();
        }
        else {
            return $this->db->get_where('users', ['userid'=> $userid])->result_array();
        }
    }
    public function deleteUserz($userid)
    {
        $this->db->delete('users',['userid'=>$userid]);
        return $this->db->affected_rows();
    }
    public function createUserz($data)
    {
        $this->db->insert('users', $data);
        return $this->db->affected_rows();
    }
    public function updateUserz($data, $userid)
    {
        $this->db->update('users',$data,['userid'=>$userid]);
        return $this->db->affected_rows();
    }
}