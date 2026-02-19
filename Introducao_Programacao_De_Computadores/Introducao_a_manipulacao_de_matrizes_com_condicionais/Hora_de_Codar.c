#include <stdio.h>

#define LINHA 10
#define COLUNA 10

int main() {

    int matriz[LINHA][COLUNA];
    int target = 90;
    int found = 0;
    int soma = 1;

    for (int i = 0; i < LINHA; i++) {
        for (int j = 0; j < COLUNA; j++) {
            matriz[i][j] = soma;
            soma++;
            printf("%d ", matriz[i][j]);
          
        }
        printf("\n");
    }

    //busca condional do elemento alvo
    for (int i = 0; i < 3; i++) {
        for (int j = 0; j < 3; j++) {
            if (matriz[i][j] == target) {
                printf("O valor %d foi encontrado na indice (%d, %d)\n", target, i, j);
                found = 1;
                break;
            }
        }
    }





}