#include   <stdio.h>
#include   <stdlib.h>
#include   <time.h>

int main() {
    int escolhaJogador, escolhaComputador;
    srand(time(0));

    printf("*** Jogo de Jokenpô ***\n");
    printf("Escolha uma opção:\n");
    printf("1. Pedra\n");
    printf("2. Papel\n");
    printf("3. Tesoura\n");
    printf("Escolha: ");
    scanf("%d", &escolhaJogador);

    escolhaComputador = rand() % 3 + 1;

    switch (escolhaJogador){
        case 1:
            printf("Você escolheu Pedra.\n");
            break;
        case 2:
            printf("Você escolheu Papel.\n");
            break;
        case 3:
            printf("Você escolheu Tesoura.\n");
            break;
        default:
            printf("Opção inválida. Por favor, escolha 1, 2 ou 3.\n");
            break;
    }
    switch (escolhaComputador){
        case 1:
            printf("O computador escolheu Pedra.\n");
            break;
        case 2:
            printf("O computador escolheu Papel.\n");
            break;
        case 3:
            printf("O computador escolheu Tesoura.\n");
            break;
    }
        if(escolhaComputador == escolhaJogador){
            printf(" ### JOOGO EMPATOU!!! ###\n");
        } else if ((escolhaJogador == 1) && (escolhaComputador == 3) ||
                    (escolhaJogador == 2) && (escolhaComputador == 1) ||
                    (escolhaJogador == 3) && (escolhaComputador == 2)) 
        {
            printf(" ### VOCÊ GANHOU!!! ###\n");
        } else {
            printf(" ### VOCÊ PERDEU!!! ###\n");
        }
    return 0;
}