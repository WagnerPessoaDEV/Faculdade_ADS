#include <stdio.h>

int main() {

    int opcao;
    int i;
    int casasTorre = 5;
    int casasBispo = 5;
    int casasRainha = 8;

//variáveis do movimento do Cavalo
    int casasBaixo = 2;
    int casasEsquerda = 1;
    int j;

    do {
        printf("\nEscolha a peça para mover:\n");
        printf("1 - Torre\n");
        printf("2 - Bispo\n");
        printf("3 - Rainha\n");
        printf("4 - Cavalo\n");
        printf("0 - Sair\n");
        printf("Opcao: ");
        scanf("%d", &opcao);

//torre - for
        if (opcao == 1) {
            printf("\nMovimento da Torre:\n");

            for (i = 0; i < casasTorre; i++) {
                printf("Direita\n");
            }
        }

//bispo - while
        else if (opcao == 2) {
            printf("\nMovimento do Bispo:\n");
            i = 0;
            while (i < casasBispo) {
                printf("Cima\n");
                printf("Direita\n");
                i++;
            }
        }

//rainha - do-while
        else if (opcao == 3) {
            printf("\nMovimento da Rainha:\n");

            i = 0;
            do {
                printf("Esquerda\n");
                i++;
            } while (i < casasRainha);
        }

//cavalo - loops aninhados (for + while)
        else if (opcao == 4) {
            printf("\nMovimento do Cavalo:\n\n");

/*
lógica do cavalo:
Movimento em "L":
2 casas para Baixo
1 casa para Esquerda

loop externo (for) controla as casas para Baixo
Loop interno (while) executa a casa para Esquerda
*/

//movimento vertical (Baixo)
            for (i = 0; i < casasBaixo; i++) {
                printf("Baixo\n");
            }

//movimento horizontal (Esquerda)
            j = 0;
            while (j < casasEsquerda) {
                printf("Esquerda\n");
                j++;
            }
        }

        else if (opcao != 0) {
            printf("\nOpcao invalida!\n");
        }

    } while (opcao != 0);

    printf("\n### Fim de Jogo.\n");

    return 0;
}
