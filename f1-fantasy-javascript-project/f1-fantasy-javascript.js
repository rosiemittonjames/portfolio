// Driver points array
const driverPoints = {
    "driver-not-selected": 0,
    "constructor-not-selected": 0,
    "o-piastri": 25,
    "l-norris": 12,
    "m-verstappen": 18,
    "g-russel": 15,
    "c-leclerc": 6,
    "l-hamilton": 4,
    "n-hulkenberg": 0,
    "k-antonelli": 0,
    "a-albon": 8,
    "l-stroll": 0,
    "e-ocon": 0,
    "o-bearman": 0,
    "y-tsunoda": 2,
    "i-hadjar": 10,
    "g-bortoleto": 1,
    "f-alonso": 0,
    "c-sainz": 0,
    "l-lawson": 0,
    "p-gasly": 0,
    "f-colapinto": 0,
  };
  
  // Constructor points array
  const constructorPoints = {
    "driver-not-selected": 0,
    "constructor-not-selected": 0,
    mclaren: 37,
    ferrari: 10,
    mercedes: 15,
    "red-bull-racing": 20,
    haas: 0,
    "racing-bulls": 10,
    williams: 8,
    "aston-martin": 0,
    "kick-sauber": 1,
    alpine: 0,
  };
  
  // Driver cost array
  const driverCost = {
    "driver-not-selected": 0,
    "constructor-not-selected": 0,
    "o-piastri": 27,
    "l-norris": 31.2,
    "m-verstappen": 28.2,
    "g-russel": 22.6,
    "c-leclerc": 23.2,
    "l-hamilton": 23.3,
    "n-hulkenberg": 9.2,
    "k-antonelli": 15.1,
    "a-albon": 12.4,
    "l-stroll": 10.5,
    "e-ocon": 8.5,
    "o-bearman": 6.7,
    "y-tsunoda": 10,
    "i-hadjar": 6.3,
    "g-bortoleto": 5.7,
    "f-alonso": 7.9,
    "c-sainz": 5.1,
    "l-lawson": 5.3,
    "p-gasly": 4.5,
    "f-colapinto": 4.5,
  };
  
  // Constructor cost array
  const constructorCost = {
    mclaren: 34.8,
    ferrari: 30.5,
    mercedes: 26.3,
    "red-bull-racing": 29,
    haas: 12.6,
    "racing-bulls": 12.4,
    williams: 16.7,
    "aston-martin": 12.5,
    "kick-sauber": 10.5,
    alpine: 7.9,
  };
  
  // Selecting the DOM elements and grabbing the elements selected
  const teamNameSelect = document.getElementById("teamName");
  const driver1Select = document.getElementById("driver1");
  const driver2Select = document.getElementById("driver2");
  const driver3Select = document.getElementById("driver3");
  const constructorSelect = document.getElementById("constructor");
  const submitButton = document.querySelector(".submit");
  
  // This will update the budget they have left
  const totalBudget = 70;
  function calculateBudget(driver, constructor) {
    let spent = 0;
    for (let i = 0; i < driver.length; i++) {
        spent += driverCost[driver[i]] || 0;
    }
    spent += constructorCost[constructor] || 0;
  
    const remaining = totalBudget - spent;
  
    console.log(`Budget spent: £${spent}M, Remaining: £${remaining}M`);
  
    document.getElementById("remaining").textContent = remaining.toFixed(1);
  
    return { remaining };
  }
  
  // This will update the budget display
  function updateBudgetDisplay() {
    const driver1 = driver1Select.value;
    const driver2 = driver2Select.value;
    const driver3 = driver3Select.value;
    const constructor = constructorSelect.value;
  
    calculateBudget([driver1, driver2, driver3], constructor);
  }
  
  // This is an event listener for the budget display
  [driver1Select, driver2Select, driver3Select, constructorSelect].forEach(
    (select) => {
        select.addEventListener("change", updateBudgetDisplay);
    }
  );
  
  updateBudgetDisplay();
  
  // This will calculate the points that they've won using a loop
  function calculatePoints(driver, constructor) {
    let total = 0;
    for (let i = 0; i < driver.length; i++) {
        total += driverPoints[driver[i]] || 0;
    }
    total += constructorPoints[constructor] || 0;
  
    console.log(
        "Driver points:",
        driver.map((d) => [d, driverPoints[d]])
    );
    console.log("Constructor points:", constructorPoints[constructor]);
    console.log("Total points:", total);
  
    return total;
  }
  
  // This will show their result
  function showResult(total) {
    const teamName = document.getElementById("teamName").value;
  
    if (total >= 50) {
        alert(
            `🎉 Well done, ${teamName}! You're a championship contender! You've won ${total} points.`
        );
    } else if (total >= 30) {
        alert(`💪 Solid try, ${teamName}! You've won ${total} points.`);
    } else {
        alert(
            `🫣 It's time to go back to garage, ${teamName}. You only won ${total} points.`
        );
    }
  }
  
  //This is a boolean which checks if it's within budget
  function isWithinBudget(driver, constructor) {
    const { remaining } = calculateBudget(driver, constructor);
    return remaining >= 0;
  }
  
  //This is a boolean which checks if there's duplicate drivers
  function isDuplicatedDrivers(drivers) {
    return new Set(drivers).size < drivers.length;
  }
  
  //This is for the car animation
  function carAnimation(callback) {
    const car = document.getElementById("car-animation");
    car.style.display = "block";
    car.style.left = "-100px";
  
    setTimeout(() => {
        car.style.left = "100vw";
    }, 50);
  
    setTimeout(() => {
        car.style.display = "none";
        car.style.left = "-100px";
        callback();
    }, 3000);
  }
  
  //Event Listener when pressing the submit button
  submitButton.addEventListener("click", () => {
    const driver1 = driver1Select.value;
    const driver2 = driver2Select.value;
    const driver3 = driver3Select.value;
    const constructor = constructorSelect.value;
  
    console.log("Drivers selected:", driver1, driver2, driver3);
    console.log("Constructor selected:", constructor);
  
    const driverChoices = [driver1, driver2, driver3];
  
    if (isDuplicatedDrivers(driverChoices)) {
        alert(
            `❌ You cannot pick the same driver more than once. Please choose 3 separate drivers.`
        );
        return;
    }
  
    const { remaining } = calculateBudget(
        [driver1, driver2, driver3],
        constructor
    );
  
    if (!isWithinBudget([driver1, driver2, driver3], constructor)) {
        alert(
            `❌ You are over budget. Please restart and create a team under £70M.`
        );
        return;
    }
  
    const total = calculatePoints([driver1, driver2, driver3], constructor);
  
    carAnimation(() => {
        showResult(total);
    });
  });