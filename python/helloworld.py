import sys
import time
import requests


try:

    print("Prima CTRL+C para terminar")

    while True:  # ciclo para o programa executar sem parar…
        print("Hello World!")
        r = requests.get('http://127.0.0.1/ti/api/api.php?nome=temperatura')
        time.sleep(2)

except KeyboardInterrupt:  # caso haja interrupção de teclado CTRL+C

    print("Programa terminado pelo utilizador")

except:  # caso haja um erro qualquer

    print("Ocorreu um erro:", sys.exc_info())

finally:  # executa sempre, independentemente se ocorreu exception

    print("Fim do programa")
