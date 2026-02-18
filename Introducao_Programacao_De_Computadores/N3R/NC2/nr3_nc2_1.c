#include <stdio.h>

int main() {
    int opcao;
    float nota1, nota2, media;

    printf("Menu de Gerenciamento de Estudantes\n");
    printf("1. Calcular Media\n");
    printf("2. Determinar Status do Aluno\n");
    printf("3. Sair\n");
    printf("Escolha uma opcao: ");
    scanf("%d", &opcao);

    switch (opcao) {
        case 1:
            printf("Calcular Media\n");
            printf("Digite a primeira nota:\n");
            scanf("%f", &nota1);
            printf("Digite a segunda nota:\n");
            scanf("%f", &nota2);
    //testar a condição se a nota é >= 0 e <= 10.
            if ((nota1 >= 0 && nota1 <= 10) && (nota2 >= 0 && nota2 <= 10)) {
                media = (nota1 + nota2) / 2;
                printf("A media do aluno é: %.2f\n", media);
            } else {
                printf("Entrada incorreta para uma das notas.\n");
            }
            break;
        case 2:
            printf("Determinar Status do Aluno\n");
            printf("Digite a media do aluno:\n");
            scanf("%f", &media);
            media >= 5 ? printf("Aluno Aprovado!\n") : printf("Aluno Reprovado!\n");
            break;
       case 3:
            printf("Saindo do programa...\n");
            break;

        default:
            printf("Opcao invalida.\n");
            break;
    }

    return 0;
}