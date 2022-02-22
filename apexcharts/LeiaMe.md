
# Gráficos com ApexCharts

Baseado nos videos de João Ribeiro

	https://www.youtube.com/user/JLDRPT/playlists
	
	https://www.youtube.com/watch?v=ObrwYf7lYy0

	Aula 01: APEXCHARTS #01 INTRODUÇÃO

Usando  a Biblioteca 

	https://apexcharts.com
	
## Documentação

Gráficos com conjuntos de finalidades já definidas, com menu de aplicação e podendo fazer importação;
Na Documentação da biblioteca,  buscar as informações em 'Options ( References)', por exemplo quando for animações: 

	https://apexcharts.com/docs/options/chart/animations/
	
Quando já se tem a definição do Grafico que deseja implementar a melhor forma de procurar pela documentação do Grafico é no exemplo dele.
Um exempo é o grafico de colunas:

	https://apexcharts.com/javascript-chart-demos/column-charts/basic/
	
Na Documentação  ha como reproduzir um grafico assim, depois modifique para as suas informações.
	
	

## Mão na massa
Escolhi colocar a biblioteca dentro do sistema, assim como orientado. 

	apexcharts.min.js

Adicionada a pasta 'js' e dentro dela o arquivo acima;




Criada a pasta 01 para o primeiro exercicio;


Apresentação do que esta sendo realizado:

	http://localhost/grafico/apexcharts/01/

Primeira apresentação, gráfico contendo as informações,  mas enorme da tela.




![image](https://user-images.githubusercontent.com/1613816/154949030-ace72a0f-b07d-4fce-95bf-c34a4dc8e7bd.png)

Arrumando as caracteristicas de altura e largura do Grafico;

Primeiro finalização:

![image](https://user-images.githubusercontent.com/1613816/154950374-6b2b867b-1d67-411e-9176-f2b7a7578111.png)


#### Aula 02

	APEXCHARTS #02 COMO LER A DOCUMENTAÇÃO
	
	https://www.youtube.com/watch?v=Jn5WY2ijRdA
	
Não foi criada a pasta 02.
	
#### Aula 03

	APEXCHARTS #03 CONSTRUÇÃO DE UM GRÁFICO DE BARRAS
	https://www.youtube.com/watch?v=xucT2iVS64s
	
Adicionando caracteristicas ao gráfico;
Apresentação: 
	
	http://localhost/grafico/apexcharts/03/
	
Finalização:

![image](https://user-images.githubusercontent.com/1613816/154961841-5c86a46a-ebc0-42bc-8172-3da2e6595a86.png)

Lembrando que as grades de fundo estão no gráfico, mas a imagem do meu monitor não favorece.

#### Aula 04

	APEXCHARTS #04 CONSTRUÇÃO DE UM GRÁFICO DE LINHAS
	https://www.youtube.com/watch?v=kmY_KyhiDoU
	
Modificando os graficos e acrescentando novas caracteristicas.

Tipo de curva

	https://apexcharts.com/docs/options/stroke/
	
![image](https://user-images.githubusercontent.com/1613816/154970123-616c4d4a-c2d8-42aa-a667-eda3853f9fdf.png)

#### Aula 05

	APEXCHARTS #05 CONSTRUIR GRÁFICO COM PHP E MYSQL
	https://www.youtube.com/watch?v=V55q_6nx1B8
	
Vamos usar 'laragon' para gerenciar o Dados:



Criando a base de dados:
	base_de_dados
Criando a tabela:

	use base_de_dados;
	CREATE TABLE dados(
 		Id_Dados int(11) NOT NULL auto_increment PRIMARY KEY,
 		Homens int(11),
 		Mulheres int(11)
	);

Inserindo dados na Tabela:

	INSERT INTO dados (Homens, Mulheres)VALUES (10,18);
	
![image](https://user-images.githubusercontent.com/1613816/154974546-a76199e8-e898-48b6-ba31-813c14088768.png)

Apresentação da página: 
	
	http://localhost/grafico/apexcharts/05/
	
Resultado trazendo as informações do banco ( modificado os valores ):

![image](https://user-images.githubusercontent.com/1613816/154979884-b375f337-607a-4332-9319-93051d1050be.png)

#### Aula 06

	APEXCHARTS #06 CONSTRUIR GRÁFICO COM PHP E MYSQL AINDA MAIS DINÂMICO
	https://www.youtube.com/watch?v=06tTS7t3saU
	
Pegando os dados do banco de dados e mostrando conforme  for o resultado:

![image](https://user-images.githubusercontent.com/1613816/154988550-215e2a32-15f1-4d34-a228-65638302ecd7.png)

#### Aula 07

	APEXCHARTS #07 ATUALIZAR DADOS DE UM GRÁFICO SEM REFRESCAR A PÁGINA
	https://www.youtube.com/watch?v=LuKv944GufQ
	
Iremos adicionar um botão no index.html  para ele alterar os dados ja existentes.

Método updateSeries

	https://apexcharts.com/docs/methods/#updateSeries
	
![image](https://user-images.githubusercontent.com/1613816/155004128-95001c02-26ce-4297-a6b8-59923e2b3c7e.png)

![image](https://user-images.githubusercontent.com/1613816/155004173-5811eee9-9a24-4e7c-b8a0-27783f5acd44.png)

Na primeira imagem as informações do Grafico original,  na segunda imagem as informações após clicar no botao 'Alterar'.

#### Aula 08 

	APEXCHARTS #08 ATUALIZAÇÃO DO GRÁFICO COM AJAX
	https://www.youtube.com/watch?v=SAPalLkcGKw
	
Para a aula 08 iremos usar além da biblioteca `ApexCharts`, as bibliotecas `bootstrap` e `axios`;

Será criada a pasta 'libs' e  a pasta 'ajax'
Dentro da pasta 'ajax' será criado o arquivo 'script.php';

Dentro da pasta 'libs' terá as bibliotecas;

 ##### bootstrap 5
 
 	https://getbootstrap.com/docs/5.0/getting-started/introduction/


CSS

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

Buscar a Pagina
	
	https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css

salvo como: 'bootstrap_v5-0-2.min.css'


##### axios cdn

	https://cdnjs.com/libraries/axios
	https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js


salvo na pasta 'libs' com o nome de 'axios.min.js'

Adicionada nesta pasta a bilbioteca de ApexCharts,  obtida anteriormente;

Para este exemplo teremos um grafico com 4 botões, ao clicar em cada um dos Botoes o grafico receberá as series  referente a este botão.

![image](https://user-images.githubusercontent.com/1613816/155039922-24a8a219-5ada-4924-891c-9e121eaba895.png)

![image](https://user-images.githubusercontent.com/1613816/155039955-dc3afe37-a8ee-418a-bf86-6167433a842e.png)

Todos os 4 trimestre sendo mostrado com  seus respectivos valores. 
Entretanto as informações ainda são estáticas. 

#### Aula 09

	APEXCHARTS #09 GRÁFICO DE BARRAS COM AJAX E COM ATUALIZAÇÃO A CADA SEGUNDO
	https://www.youtube.com/watch?v=cP2u9rDp3d4
	
Grafico será modificado a cada determinado intervalo de  tempo;
Comunicação via ajax;
As informações são geradas randomicamente;

![image](https://user-images.githubusercontent.com/1613816/155049167-4e18203a-4ed1-4c57-9c46-bdf5589180e4.png)

Ao clicar no botao 'Start' começa a alimentar o grafico. No botao 'Stop' para o grafico como esta.


#### Aula 10

	APEXCHARTS #10 PROJETO FINAL COM PHP, AJAX E MYSQL
	https://www.youtube.com/watch?v=Rpe9BMzGoEs
	


	

