#include <stdio.h>

int main() {

    int idade = 17;
    float altura = 1.75f;

    if(idade >= 18 && idade <= 30 && altura > 1.70) {
        printf("A pessoa está dentro do grupo de idade e altura desejados.\n");
        
    } else {
        printf("A pessoa não atende aos critérios de idade e altura.\n");
        
    }
    return 0;
}