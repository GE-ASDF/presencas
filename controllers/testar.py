import requests
import json
def buscar_usuario():
    CodigoContrato = input("Digite o usuário do aluno:")
    SenhaAluno = input("Digite a senha do aluno:")
    request = requests.get("http://192.168.1.11/presencas/controllers/apicontroller.php?CodigoContrato="+CodigoContrato+"&SenhaAluno="+SenhaAluno)
    return request.content

res = json.loads(buscar_usuario())

print(res['CodigoContrato'])