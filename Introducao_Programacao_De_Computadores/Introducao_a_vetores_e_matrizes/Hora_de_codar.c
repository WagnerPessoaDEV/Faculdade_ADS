#include <stdio.h>

int main() {
    int index;
    
    // Matriz de strings (ponteiros para char)
    char *nomesAlunos[3][3] = {
        {"Manuella", "Português: 30", "Matemática: 90"},
        {"Valemtin", "Português: 60", "Matemática: 60"},
        {"Miguel", "Português: 90", "Matemática: 30"},
    };

    printf("Digite o numero do aluno (0 a 2): ");
    if (scanf("%d", &index) != 1) {
        printf("Erro: Digite apenas números.\n");
        return 1;
    }

    // Verificação de segurança
    if (index >= 0 && index < 3) {
        printf("\nAs notas de %s são: %s e %s.\n", 
                nomesAlunos[index][0], 
                nomesAlunos[index][1], 
                nomesAlunos[index][2]);
    } else {
        printf("\nErro: Aluno não encontrado! Escolha entre 0, 1 ou 2.\n");
    }

    return 0;
}