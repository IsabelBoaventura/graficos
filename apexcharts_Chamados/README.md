# Graficos Dos Chamados

Usando:
  * Laragon  5.0.0
  * PHP 7.4.19
  * ApexCharts
  * Banco de Dados: simples_controle
  * HTML, CSS, ...

Usando como base as videos aulas de João Ribeiro  https://www.youtube.com/channel/UC6ZL0QLBNKBAOx6vjQXTIJA ;
  
No momento apenas testes trazendo as informações do banco de Dados, da tabela `chamados`;

Tendo as informações do banco de dados , criar a nova tabela `chamados_totais`, e inserir estas informações nesta tabela;


## Características do Projeto:

	1 - Totais de chamados por dia/semana/mes/ano;
		1.1 Totais de chamados finalizados ( por dia? )
		1.2 Totais de chamados por situações ( dia/semana/mes/ano );
	2 - Cliente que mais solicitou  abertura de chamado
	3 - Usuario do suporte x quantidade de atendimentos prestados por dia/semana/mês/ano
	4 - Pico de maior horário de atendimento no suporte - maior fluxo de chamados;


## Banco de Dados 

* Tabela Semanas;
Apartir da Semana poder buscar os dias;

	CREATE TABLE IF NOT EXISTS `semanas` (
		Id_Semana  int(11) NOT NULL auto_increment PRIMARY KEY,
		AnoSemana int(6) NOT NULL,
		DataInicio date,
		DataFim date
	);

* Tabela Chamados_Totais;
Para facilitar a busca dos dados no dia ou por periodo; 
Neste momento ( acredito que irá ficar apenas assim) contém o total de chamados por Atendentes;

	CREATE TABLE IF NOT EXISTS `chamados_totais` (
		Id_Total  int(11) NOT NULL auto_increment PRIMARY KEY,
		Data_Atendimento date   ,
		Atendente int(11) , 
		Total_Atendente int(11) ,
		Total_Finalizados INT(11), 
		created_at datetime ,
		updated_at datetime ,
		Situacao char(1)
	);

## SQL de Consultas 

Algumas sql que foi usada apenas no banco de dados para se obter os resultados, assim tendo como comparar com os resultados que o sistema trouxe;

   * Quantidade por dia, por atendente e Finalizado;

	SELECT * FROM chamado
	WHERE DH_Chamado >= '2022-02-18 00:00:01' 
	AND DH_Chamado <= '2022-02-18 23:59:59' 
	AND Usuario_Atendimento= '5' 
	AND Finalizado = 'S' ;  

