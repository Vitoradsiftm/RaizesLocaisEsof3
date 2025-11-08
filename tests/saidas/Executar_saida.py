from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time

driver = webdriver.Chrome()

# 1. Login
driver.get("http://localhost/raizesLocais/visao/sistema/login.php")
time.sleep(2)
driver.find_element(By.NAME, "usuario").send_keys("Vitor")
driver.find_element(By.NAME, "senha").send_keys("123")
driver.find_element(By.NAME, "senha").send_keys(Keys.RETURN)
time.sleep(2)

# 2. Acessa a tela de execução logística
driver.get("http://localhost/raizesLocais/visao/sistema/checklist_movimentacoes.php")

# 3. Aguarda e clica no botão "Executar" da primeira saída aprovada
try:
    WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//button[text()='Executar']"))
    )
    driver.find_element(By.XPATH, "//button[text()='Executar']").click()
    time.sleep(2)

    page = driver.page_source.lower()
    if "✅ saída de" in page or "executada com sucesso" in page:
        print("✅ Saída executada com sucesso!")
    elif "estoque insuficiente" in page:
        print("❌ Falha: estoque insuficiente para executar a saída.")
    else:
        print("⚠️ Botão clicado, mas sem confirmação visível.")
except:
    print("❌ Nenhuma saída aprovada disponível para execução.")

driver.quit()
