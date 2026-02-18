#include <stdio.h>

int main() {
    int tabuleiro[10][10] = {0};
    int i, j;
    int navio_valor = 3;

    //POSICIONAMENTO DOS NAVIOS
    
    //1. Navio Horizontal
    for (j = 1; j <= 3; j++) tabuleiro[1][j] = navio_valor;

    //2. Navio Vertical
    for (i = 4; i <= 6; i++) tabuleiro[i][8] = navio_valor;

    //3. Navio Diagonal (Sudeste)
    for (i = 0; i < 3; i++) tabuleiro[7 + i][1 + i] = navio_valor;

    //4. Navio Diagonal (Sudoeste)
    for (i = 0; i < 3; i++) tabuleiro[1 + i][7 - i] = navio_valor;

    //EXIBIÇÃO DO TABULEIRO
    printf("--- Batalha Naval (Nível Intermediário) ---\n\n");
    
    //Cabeçalho com Letras (A a J)
    printf("    ");
    for (j = 0; j < 10; j++) {
        printf("%c ", 'A' + j); 
    }

    printf("\n");

    //Loop para imprimir as linhas
    for (i = 0; i < 10; i++) {
        printf("%d | ", i); 
        
        for (j = 0; j < 10; j++) {
            printf("%d ", tabuleiro[i][j]);
        }
        printf("\n");
    }

    return 0;
}