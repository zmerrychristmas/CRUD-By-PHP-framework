<?php

class User_Model extends CI_Model {

    protected static $_table = 'users';
    protected $query;
    function __construct()
    {
        parent::__construct();
    }

    public function get($limit = 25, $offset = 0)
    {
        $this->query = $this->db;
        $result = [
            'total' =>  $this->query->count_all_results(self::$_table),
            'data'  =>  $this->query->get(self::$_table, $limit, $offset)->result()
        ];
        return $result;
    }

    public function create($data)
    {
        return $this->db->insert(self::$_table, $data);
    }

    public function findById($id)
    {
        $this->query = $this->db->where(['user_id' => $id])->get(self::$_table, 1);
        return $this->query->result();
    }

    public function update($id, $data)
    {
        $this->db->set($data);
        $this->db->where('user_id', $id);
        $this->query = $this->db->update(self::$_table, $data);
    }

    public function userEmailExists($email)
    {
        $this->query = $this->db->where(['user_email' => $email])->get(self::$_table, 1);
        return count($this->query->result()) > 0;
    }

    public function countAllUser()
    {
        return $this->db->count_all_results();
    }

    public function delete($id)
    {
        return $this->db->delete(self::$_table, "user_id = {$id}");
    }
}