Super Trunfo em C

Este é um programa simples em linguagem C que simula uma comparação de cartas no estilo Super Trunfo entre dois países: Brasil e Argentina.

O usuário escolhe um atributo e o programa informa qual país vence com base no valor selecionado.

Atributos disponíveis

População

Área

PIB

Pontos turísticos

Densidade demográfica (regra especial: menor valor vence)

Tecnologias utilizadas

Linguagem C

Compilador GCC

Como compilar e executar
1. Pré-requisitos

Você precisa ter um compilador C instalado.

Windows: Instale o MinGW ou use o WSL

Linux/Mac: O GCC geralmente já vem instalado ou pode ser instalado pelo gerenciador de pacotes

Para verificar se o GCC está instalado:

gcc --version

2. Compilando o programa

No terminal, navegue até a pasta do projeto e execute:

gcc super_trunfo.c -o super_trunfo


Isso criará o arquivo executável.

3. Executando o programa
Linux/Mac:
./super_trunfo

Windows:
super_trunfo.exe

Como usar

Execute o programa

Escolha um número de 1 a 5 correspondente ao atributo desejado

O programa exibirá os valores dos dois países

O vencedor será mostrado na tela

Exemplo de saída
### SUPER TRUNFO ###
Escolha um atributo:
1 - Populacao
2 - Area
3 - PIB
4 - Pontos Turisticos
5 - Densidade Demografica
Digite o numero da opcao: 1

### RESULTADO DA COMPARACAO ###
Atributo: Populacao
Brasil: 214 vs Argentina: 45
Vencedor: Brasil

Objetivo do projeto

Projeto desenvolvido para praticar conceitos básicos de programação em C:

Variáveis

Estruturas condicionais (if/else)

Estrutura de seleção (switch)

Entrada e saída de dados (scanf e printf)

Autor

Wagner Pessoa
Estudante de Análise e Desenvolvimento de Sistemas.