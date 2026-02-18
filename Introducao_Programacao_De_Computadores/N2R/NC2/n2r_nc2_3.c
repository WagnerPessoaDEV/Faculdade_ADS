#include    <stdio.h>

int main(){

    int nota;

    printf("Digite a sua nota:\n");
    scanf("%d", &nota);
    //A >= 90
    //B >= 80
    //C >= 70
    //D >= 60
    //E >= 50
    //F < 60
    if (nota >= 90){
        printf("Seu conceito é A\n");
    } else if (nota >= 80){
        printf("Seu conceito é B\n");
    } else if (nota >= 70){
        printf("Seu conceito é C\n");
    } else if (nota >= 60){
        printf("Seu conceito é D\n");
    } else if (nota >= 50){
        printf("Seu conceito é E\n");
    } else {
        printf("Seu conceito é F\n");
    }

    return 0;
}