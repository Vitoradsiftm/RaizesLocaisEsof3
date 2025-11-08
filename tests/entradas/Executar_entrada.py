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

# 3. Aguarda e clica no botão "Executar" da primeira entrada aprovada
try:
    WebDriverWait(driver, 10).until(
        EC.presence_of_element_located((By.XPATH, "//button[text()='Executar']"))
    )
    driver.find_element(By.XPATH, "//button[text()='Executar']").click()
    time.sleep(2)
    if "executada com sucesso" in driver.page_source.lower():
        print("✅ Entrada executada com sucesso!")
    else:
        print("⚠️ Botão clicado, mas não foi possível confirmar a execução.")
except:
    print("❌ Nenhuma entrada aprovada disponível para execução.")

driver.quit()
