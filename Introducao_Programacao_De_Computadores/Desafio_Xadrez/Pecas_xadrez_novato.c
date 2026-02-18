#include <stdio.h>

int main() {

    int opcao;
    int i;
    int casasTorre = 5;
    int casasBispo = 5;
    int casasRainha = 8;

    do {
        printf("\nEscolha a peça para mover:\n");
        printf("1 - Torre\n");
        printf("2 - Bispo\n");
        printf("3 - Rainha\n");
        printf("0 - Sair\n");
        printf("Opcao: ");
        scanf("%d", &opcao);
 //TORRE - FOR
        if (opcao == 1) {
            printf("\nMovimento da Torre:\n");

            for (i = 0; i < casasTorre; i++) {
                printf("Direita\n");
            }
        }
//BISPO - WHILE
        else if (opcao == 2) {
            printf("\nMovimento do Bispo:\n");
            i = 0;
            while (i < casasBispo) {
                printf("Cima, Direita\n");
                i++;
            }
        }
//RAINHA - DO-WHILE
        else if (opcao == 3) {
            printf("\nMovimento da Rainha:\n");

            i = 0;
            do {
                printf("Esquerda\n");
                i++;
            } while (i < casasRainha);
        }

        else if (opcao != 0) {
            printf("\nOpção inválida!\n");
        }

    } while (opcao != 0);
    printf("\n###Fim de JOGO.\n");

    return 0;
}
