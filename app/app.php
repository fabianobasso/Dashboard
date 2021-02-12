<?php

// classe Dashboard
class Dashboard {

    public $dataInicio;
    public $dataFim;
    public $numeroVendas;
    public $totalVendas;
    public $clientesAtivos;
    public $clientesInativos;
    public $totalReclamacao;
    public $totalElogio;
    public $totalSugestao;
    public $totalDespesa;

    // Métodos magicos get e set
    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
        return $this;
    }
}

// classe de Conexão com o banco

class Conexao{
    private $dbName = '../db/dashboard.db';

    public function conectar(){

        try{

            $conexao = new PDO("sqlite:$this->dbName");
            return $conexao;

        }catch (PDOException $e){
            echo "<p> {$e->getMessage()} </p>";
        }
    }
}

// classe model BD

class Bd{
    private $conexao;
    private $dashboard;

    public function __construct(Conexao $conexao, Dashboard $dashboard){
        $this->conexao = $conexao->conectar();
        $this->dashboard = $dashboard;
    }

    public function getNumeroVendas(){
        $query = "select 
                        count(*) as numero_vendas 
                    from 
                        tb_vendas 
                    WHERE 
                        data_venda between :dataInicio and :dataFim";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':dataFim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->numero_vendas;
    }

    public function getTotalVendas(){
        $query = "select 
                        sum(total) as total_vendas 
                    from 
                        tb_vendas 
                    WHERE 
                        data_venda between :dataInicio and :dataFim";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':dataFim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->total_vendas;
    }

    public function getClientesAtivosInativo($condicao){
        $query = "select 
                        count(*) as ativo 
                    from 
                        tb_clientes 
                    where 
                        cliente_ativo = :condicao";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':condicao', $condicao);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->ativo;
    }

    public function getTipoContato($tipoContato){
        $query = "select count(*) as tipo from tb_contatos where tipo_contato = :tipoContato";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tipoContato', $tipoContato);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->tipo;
    }

    public function getTotalDespesas(){
        $query = "select 
                        sum(total) as total_despesa 
                    from 
                        tb_despesas 
                    WHERE 
                        data_despesa between :dataInicio and :dataFim";

        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':dataInicio', $this->dashboard->__get('dataInicio'));
        $stmt->bindValue(':dataFim', $this->dashboard->__get('dataFim'));
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ)->total_despesa;
    }

    
}

// Lógica do script

$dashboard = new Dashboard();
$conexao = new Conexao();

$competencia = explode('-', $_GET['competencia']);
$ano = $competencia[0];
$mes = $competencia[1];

// função para ver quantos dias tem no mes como estamos no brasil usar CAL_GREGORIAN
$diasDoMes = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

$dashboard->__set('dataInicio', "{$ano}-{$mes}-01");
$dashboard->__set('dataFim', "{$ano}-{$mes}-{$diasDoMes}");

$bd = new Bd($conexao, $dashboard);
$dashboard->__set('numeroVendas', $bd->getNumeroVendas());
$dashboard->__set('totalVendas', $bd->getTotalVendas());
$dashboard->__set('clientesAtivos', $bd->getClientesAtivosInativo(1));
$dashboard->__set('clientesInativos', $bd->getClientesAtivosInativo(0));
// elogio=3 reclamação=1 e sugestão=2
$dashboard->__set('totalReclamacao', $bd->getTipoContato(1));
$dashboard->__set('totalElogio', $bd->getTipoContato(3));
$dashboard->__set('totalSugestao', $bd->getTipoContato(2));
$dashboard->__set('totalDespesa', $bd->getTotalDespesas());
// retorno 
echo json_encode($dashboard);
?>