function countER(subs, cover){
    let val = subs > 0 && cover > 0 ? (cover / subs) * 100 : 0;

    if(val - 1 < 0) val = Math.round(val);
    else val = Math.ceil(val);

    return val;
}

export { countER }
