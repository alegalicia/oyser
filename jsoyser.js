if ("geolocation" in navigator) {
  /* la geolocalización está disponible */
  let latitud = 0;
  let longitud = 0;

  navigator.geolocation.getCurrentPosition(function (position) {
    //haz_algo(position.coords.latitude, position.coords.longitude);
    latitud = position.coords.latitude;
    longitud = position.coords.longitude;
    console.log("latitud: " + latitud + " longitud: " + longitud);
    var x = location.hostname;
    console.log(x);
    let getBrowserInfo = function () {
      let ua = navigator.userAgent,
        tem,
        M =
          ua.match(
            /(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i
          ) || [];
      if (/trident/i.test(M[1])) {
        tem = /\brv[ :]+(\d+)/g.exec(ua) || [];
        return "IE " + (tem[1] || "");
      }
      if (M[1] === "Chrome") {
        tem = ua.match(/\b(OPR|Edge)\/(\d+)/);
        if (tem != null) return tem.slice(1).join(" ").replace("OPR", "Opera");
      }
      M = M[2] ? [M[1], M[2]] : [navigator.appName, navigator.appVersion, "-?"];
      if ((tem = ua.match(/version\/(\d+)/i)) != null) M.splice(1, 1, tem[1]);
      return M.join(" ");
    };
  });

} else {
  /* la geolocalización NO está disponible */
  console.log("no llega");
}
