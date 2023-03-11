type Tresult = {
  name?: string;
  city?: string;
  car?: string;
  best?: string;
};

class createModal {
  public getWinnerInfo() {
    const winner = document.getElementsByTagName("tr");
    const best = document.getElementsByClassName("table__cell--active");
    let result: Tresult = {
      name: "",
      city: "",
      car: "",
      best: "",
    };

    if (winner) {
      const name = winner[1].querySelector(".table__cell--name");
      const city = winner[1].querySelector(".table__cell--city");
      const car = winner[1].querySelector(".table__cell--car");

      if (name?.textContent) {
        result.name = name.textContent;
      }

      if (city?.textContent) {
        result.city = city.textContent;
      }

      if (car?.textContent) {
        result.car = car.textContent;
      }
    }

    if (best && best[1] && best[1].textContent) {
      result.best = best[1].textContent;
    }

    return result;
  }
  public destroyModal() {
    const modal = document.querySelector(".modal");

    if (modal) {
      modal.remove();
    }
  }
  public createModal() {
    const modal = document.createElement("div");
    modal.className = "modal";

    const modalWrapper = document.createElement("div");
    modalWrapper.className = "modal__wrapper";
    modal.appendChild(modalWrapper);

    const closeButton = document.createElement("button");
    closeButton.className = "modal__close-button";
    const closeButtonText = document.createTextNode("close");
    closeButton.appendChild(closeButtonText);
    modalWrapper.appendChild(closeButton);

    modalWrapper.addEventListener("click", (event) => {
      event.stopPropagation();
    });

    modal.addEventListener("click", this.destroyModal);

    closeButton.addEventListener("click", this.destroyModal);

    const main = document.querySelector(".content");

    if (modal && main) {
      document.body.insertBefore(modal, main);
    }
  }
  public addWinnerInfoInModal() {
    const winnerInfo = this.getWinnerInfo();
    this.createModal();

    const modalWrapper = document.querySelector(".modal__wrapper");
    const table = document.createElement("table");
    const rowHeader = document.createElement("tr");
    const rowResult = document.createElement("tr");

    for (const key in winnerInfo) {
      if (winnerInfo[key as keyof Tresult]) {
        const tdHeader = document.createElement("td");
        const tdResult = document.createElement("td");
        tdHeader.className = "animation-cell";
        tdResult.className = "animation-cell";
        const headerText = document.createTextNode(key);
        tdHeader.appendChild(headerText);
        // @ts-ignore
        const resultText = document.createTextNode(winnerInfo[key]);
        tdResult.appendChild(resultText);
        rowHeader.appendChild(tdHeader);
        rowResult.appendChild(tdResult);
      }
    }

    if (rowResult.children && modalWrapper) {
      table.appendChild(rowHeader);
      table.appendChild(rowResult);
      modalWrapper.appendChild(table);
    }
  }
}

const Modal = new createModal();

Modal.addWinnerInfoInModal();
