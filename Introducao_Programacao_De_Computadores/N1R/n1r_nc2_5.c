#include <stdio.h>

int main() {

    int Idade1 = 10;
    int Idade2 = 30;

    if (Idade1 > Idade2) {
        printf("Pessoa 1 é mais velha que a Pessoa 2\n");
    } 
        else if (Idade1 < Idade2) {
        printf("Pessoa 1 é mais nova que a Pessoa 2\n");
    } 
        else if (Idade1 == Idade2) {
        printf("As pessoas têm a mesma idade\n");
    }

}