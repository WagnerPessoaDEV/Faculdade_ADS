#include   <stdio.h>
#include   <stdlib.h>
#include   <time.h>

int main() {
    int opcao;
    int numeroSecreto, palpite;

    printf("Menu Principal\n");
    printf("1. Iniciar o Jogo\n");
    printf("2. Ver Regras\n");
    printf("3. sair\n");
    printf("Escolha uma opção: ");
    scanf("%d", &opcao);

    switch (opcao) {
        case 1:
            srand(time(0));
            numeroSecreto = rand() % 10;
            printf("Digite um número entre 0 e 9: ");
            scanf("%d", &palpite);
            if (numeroSecreto == palpite) {
                printf("Você acertou!\n");
            } else {
                printf("Você errou!\n");
                printf("Número secreto gerado %d\n", numeroSecreto);
            }
            break;
        case 2:
        printf("A explicação das regras do jogo é a seguinte: O jogador deve adivinhar um número secreto gerado aleatoriamente entre 0 e 9. O jogador tem apenas uma chance para acertar o número. Se o jogador acertar, ele ganha; caso contrário, ele perde e o número secreto é revelado.\n");
            break;
        case 3:
            printf("Saindo do jogo. Até mais!\n");  
    }    
    return 0;

    }