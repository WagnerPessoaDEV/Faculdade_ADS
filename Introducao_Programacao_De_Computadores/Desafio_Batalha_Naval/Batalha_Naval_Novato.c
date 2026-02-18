#include <stdio.h>

#define TAM 10
#define NAVIO 3

int main() {
//matriz que representa o tabuleiro
    int tabuleiro[TAM][TAM];
//inicializa o tabuleiro com 0 (água)
    for (int i = 0; i < TAM; i++) {
        for (int j = 0; j < TAM; j++) {
            tabuleiro[i][j] = 0;
        }
    }
//vetores que representam os navios (valor 3)
    int navio_horizontal[NAVIO] = {3, 3, 3};
    int navio_vertical[NAVIO]   = {3, 3, 3};
//coordenadas iniciais (definidas no código)
    int linhaH = 2, colunaH = 4; //navio horizontal
    int linhaV = 5, colunaV = 7; //navio vertical
//posiciona o navio horizontal
    if (colunaH + NAVIO <= TAM) { //verifica limite horizontal
        int podeColocar = 1;
//verifica sobreposição
        for (int i = 0; i < NAVIO; i++) {
            if (tabuleiro[linhaH][colunaH + i] != 0) {
                podeColocar = 0;
            }
        }
//copia para o tabuleiro
        if (podeColocar) {
            for (int i = 0; i < NAVIO; i++) {
                tabuleiro[linhaH][colunaH + i] = navio_horizontal[i];
            }
        } else {
            printf("Erro: Navio horizontal sobrepoe outro.\n");
        }
    } else {
        printf("Erro: Navio horizontal fora do tabuleiro.\n");
    }
//posiciona o navio vertical
    if (linhaV + NAVIO <= TAM) { 
        int podeColocar = 1;
  //verifica sobreposição
        for (int i = 0; i < NAVIO; i++) {
            if (tabuleiro[linhaV + i][colunaV] != 0) {
                podeColocar = 0;
            }
        }
//copia para o tabuleiro
        if (podeColocar) {
            for (int i = 0; i < NAVIO; i++) {
                tabuleiro[linhaV + i][colunaV] = navio_vertical[i];
            }
        } else {
            printf("Erro: Navio vertical sobrepoe outro.\n");
        }
    } else {
        printf("Erro: Navio vertical fora do tabuleiro.\n");
    }
//exibe o tabuleiro
    printf("\nTabuleiro Batalha Naval:\n\n");

    for (int i = 0; i < TAM; i++) {
        for (int j = 0; j < TAM; j++) {
            printf("%d ", tabuleiro[i][j]);
        }
        printf("\n");
    }

    return 0;
}
