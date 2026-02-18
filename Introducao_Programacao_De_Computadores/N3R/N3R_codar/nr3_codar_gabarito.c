#include    <stdio.h>
#include    <stdlib.h>
#include    <time.h>

int main(){
    int numeroJogador, numeroComputador, resultado;
    char tipoComparacao;

//Gerar número aleatório
    srand(time(0));
    numeroComputador = rand() % 100 + 1; // Gera um número entre 1 e 100

//Inicio do Game
    printf("***Bem-Vindo ao Jogo Maior, Menor ou Igual!***\n");
    printf("Você deve escolher um número e o tipo de comparação.\n");
    printf("M. Maior\n");
    printf("N. Menor\n");
    printf("I. Igual\n");

    printf("Escolha a comparação (M/N/I):\n");
    scanf(" %c", &tipoComparacao);

    printf("Digite seu número (1-100):\n");
    scanf("%d", &numeroJogador);

//Exibir número do computador
    printf("Número do Computador: %d\n", numeroComputador);

    switch (tipoComparacao) {
        case 'M':
        case 'm':
            resultado = numeroJogador > numeroComputador ? 1 : 0;
            resultado == 1 ? printf("Parabéns! Você acertou, seu número é MAIOR que o do computador.\n") : printf("Que pena! Você errou, seu número não é MAIOR que o do computador.\n");
            break;

        case 'N':
        case 'n':
            resultado = numeroJogador < numeroComputador ? 1 : 0;
            resultado == 1 ? printf("Parabéns! Você acertou, seu número é MENOR que o do computador.\n") : printf("Que pena! Você errou, seu número não é MENOR que o do computador.\n");
            break;

        case 'I':
        case 'i':
            resultado = numeroJogador == numeroComputador ? 1 : 0;
            resultado == 1 ? printf("Parabéns! Você acertou, seu número é IGUAL ao do computador.\n") : printf("Que pena! Você errou, seu número não é IGUAL ao do computador.\n");
            break;
        default:
            printf("Opção inválida. Por favor, escolha M, N ou I.\n");
            break;
    }

    if (resultado == 1) {
        printf("Parabéns!Você venceu o GAME!\n");
    } else {
        printf("Infelizmente você perdeu o GAME. Tente novamente!\n");
    }

}