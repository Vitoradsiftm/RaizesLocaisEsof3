from selenium import webdriver
from selenium.webdriver.common.by import By
import time
import random

driver = webdriver.Chrome()

# 1. Acessa a tela de cadastro
driver.get("http://localhost/raizesLocais/visao/sistema/criarConta.php")
time.sleep(2)

# 2. Preenche os campos do formulário
nome = "Usuário Teste"
email = f"teste{random.randint(1000,9999)}@exemplo.com"
usuario = f"teste{random.randint(1000,9999)}"
senha = "123456"

driver.find_element(By.NAME, "nome").send_keys(nome)
driver.find_element(By.NAME, "email").send_keys(email)
driver.find_element(By.NAME, "usuario").send_keys(usuario)
driver.find_element(By.NAME, "senha").send_keys(senha)

# 3. Clica no botão "Cadastrar"
driver.find_element(By.XPATH, "//button[text()='Cadastrar']").click()
time.sleep(2)

# 4. Verifica se o cadastro foi bem-sucedido
if "conta criada" in driver.page_source.lower() or "cadastro realizado" in driver.page_source.lower():
    print(f"✅ Usuário '{usuario}' cadastrado com sucesso!")
else:
    print("❌ Falha ao cadastrar o usuário.")

driver.quit()
