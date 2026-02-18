#include    <stdio.h>

int main() {
    int opcao;

    printf("Menu Principal\n");
    printf("1 - Iniciar Jogo\n");
    printf("2 - Ver Regras\n");
    printf("3 - Sair\n");
    printf("Escolha uma opcao: ");
    scanf("%d", &opcao);

    switch(opcao) {
        case 1:
            printf("Iniciando o jogo...\n");
            break;
        case 2:
            printf("As regras do jogo são:\n");
            break;
        case 3:
            printf("Saindo do jogo. Até logo!\n");
            break;
        default:
            printf("Opcao invalida. Tente novamente.\n");
    }

return 0;

}