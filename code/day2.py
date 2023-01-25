import fileHandle


def puzzle3(input_file):
    data = fileHandle.readfile(input_file).strip().splitlines()
    score = 0
    for round_ in data:
        hand1 = ord(round_[0]) - ord('A')
        hand2 = ord(round_[2]) - ord('X')
        score += hand2 + 1
        match hand2 - hand1:
            case 0:
                score += 3
            case 1 | -2:
                score += 6
    return score


def puzzle4(input_file):
    data = fileHandle.readfile(input_file).strip().splitlines()
    score = 0
    for round_ in data:
        hand1 = ord(round_[0]) - ord('A')
        result = ord(round_[2]) - ord('X')
        score += 3 * result
        match result:
            case 0:  # lose
                score += (hand1 - 1) % 3 + 1
            case 1:  # draw
                score += hand1 + 1
            case 2:  # win
                score += (hand1 + 1) % 3 + 1
    return score


print('Day #2, part one:', puzzle3('.\input\day2.txt'))
print('Day #2, part two:', puzzle4('.\input\day2.txt'))