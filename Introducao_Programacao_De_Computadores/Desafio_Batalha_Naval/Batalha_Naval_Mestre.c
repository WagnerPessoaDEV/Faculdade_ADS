#include <stdio.h>

#define TAM_TABULEIRO 10
#define TAM_HABILIDADE 5

//definição de valores para o tabuleiro
#define AGUA 0
#define NAVIO 3
#define HABILIDADE 5

void exibirTabuleiro(int tabuleiro[TAM_TABULEIRO][TAM_TABULEIRO]) {
    for (int i = 0; i < TAM_TABULEIRO; i++) {
        for (int j = 0; j < TAM_TABULEIRO; j++) {
            printf("%d ", tabuleiro[i][j]);
        }
        printf("\n");
    }
    printf("\n");
}

int main() {
    int tabuleiro[TAM_TABULEIRO][TAM_TABULEIRO] = {0};

    //posicionando alguns navios estáticos para demonstração
    for (int j = 2; j < 5; j++) tabuleiro[2][j] = NAVIO;
    for (int i = 5; i < 8; i++) tabuleiro[i][8] = NAVIO;

    //definindo as Matrizes de Habilidade (5x5)
    int cone[TAM_HABILIDADE][TAM_HABILIDADE] = {0};
    int cruz[TAM_HABILIDADE][TAM_HABILIDADE] = {0};
    int octaedro[TAM_HABILIDADE][TAM_HABILIDADE] = {0};

    //construção Dinâmica das Habilidades com Condicionais
    for (int i = 0; i < TAM_HABILIDADE; i++) {
        for (int j = 0; j < TAM_HABILIDADE; j++) {
            // Lógica do Cone (Triângulo isósceles para baixo)
            if (i == 0 && j == 2) cone[i][j] = 1;
            if (i == 1 && j >= 1 && j <= 3) cone[i][j] = 1;
            if (i == 2) cone[i][j] = 1;

            //lógica da Cruz (Linha central e Coluna central)
            if (i == 2 || j == 2) cruz[i][j] = 1;

            //lógica do Octaedro (Losango / Diamante) | baseado na distância de Manhattan ao centro (2,2)
            if (i + j >= 2 && j - i <= 2 && i - j <= 2 && i + j <= 6) {
                
                if (!((i == 0 && j != 2) || (i == 4 && j != 2) || (j == 0 && i != 2) || (j == 4 && i != 2))) {
                    octaedro[i][j] = 1;
                }
            }
        }
    }

    //sobreposição no Tabuleiro | definindo pontos de origem (centro da matriz 5x5 no tabuleiro 10x10)
    int origens[3][2] = {
        {1, 1}, // Origem Cone (Topo superior esquerdo)
        {4, 4}, // Origem Cruz (Centro)
        {7, 2}  // Origem Octaedro (Inferior)
    };

    //aplicando as habilidades
    for (int h = 0; h < 3; h++) {
        int linOrigem = origens[h][0];
        int colOrigem = origens[h][1];

        for (int i = 0; i < TAM_HABILIDADE; i++) {
            for (int j = 0; j < TAM_HABILIDADE; j++) {
                
                int tabLin = linOrigem + i - 2; 
                int tabCol = colOrigem + j - 2;

                if (tabLin >= 0 && tabLin < TAM_TABULEIRO && tabCol >= 0 && tabCol < TAM_TABULEIRO) {
                    
                    int valorHabilidade = 0;
                    if (h == 0) valorHabilidade = cone[i][j];
                    if (h == 1) valorHabilidade = cruz[i][j];
                    if (h == 2) valorHabilidade = octaedro[i][j];

                    if (valorHabilidade == 1) {
                        tabuleiro[tabLin][tabCol] = HABILIDADE;
                    }
                }
            }
        }
    }

    //exibição Final
    printf("TABULEIRO FINAL (0: Água, 3: Navio, 5: Habilidade):\n");
    exibirTabuleiro(tabuleiro);

    return 0;
}