<?php

    function connectDB(){
        try{
            $conn = new PDO('sqlite:../db/dashboard.db');
            return $conn;
        }catch (Exception $e){
            die('Entrar em contato com o administrador');
        } 
    }
?>