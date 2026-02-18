#include <stdio.h>

int main() {
    int num1 = 40, num2 = 60;
    int maior;

    //operador ternário para encontrar o maior número
    
    num1 > num2 ? (maior = num1) : (maior = num2);
    printf("O maior número é: %d\n", maior);

    
    //mesma coisa que a cima porem em if e else

    if (num1 > num2) {
        printf("O maior número é: %d\n", num1);
    } else {
        printf("O maior número é: %d\n", num2);
    }



    return 0;
}